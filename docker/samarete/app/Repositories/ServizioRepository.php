<?php

namespace Samarete\Repositories;

use Illuminate\Support\Facades\DB;

use Samarete\Models\Servizio;
use Samarete\Models\Associazione;

use Samarete\Repositories\FileRepository;

class ServizioRepository
{
    public static function getAll($query = '')
    {
        $servizi = array();
        $a = new Servizio;
        if(!empty($query)){
            $query = '%'.$query.'%';
            $a = $a->whereRaw('LOWER(nome) LIKE ?', [$query])->orWhereRaw('LOWER(oggetto) LIKE ?', [$query])->orWhereRaw('LOWER(descrizione) LIKE ?', [$query])->get();
        }else{
            $a = $a->all();
        }
        foreach($a as $servizio){
            $servizio->logo_base64 = self::getLogoBase64($servizio);
            $servizio->giorni = self::getGiorni($servizio);
            $servizi[] = $servizio;
        }
        return $servizi;
    }
    
    public static function getByNome($name)
    {
        $servizio = Servizio::where('nome', $name)->first();
        $servizio->logo_base64 = self::getLogoBase64($servizio);
        $servizio->giorni = self::getGiorni($servizio);
        return $servizio;
    }
    
    public static function getById($id)
    {
        $servizio = Servizio::where('id', $id)->first();
        $servizio->logo_base64 = self::getLogoBase64($servizio);
        $servizio->giorni = self::getGiorni($servizio);
        return $servizio;
    }
    
    private static function getGiorni(Servizio $servizio)
    {
        if(empty($servizio)) return array();
        return $servizio->getGiorni();
    }
    
    public static function servizioHasAssociazione(Servizio $servizio, Associazione $associazione)
    {
        $result = DB::select('
            SELECT *
            FROM associazione_has_servizio
            WHERE associazione_id = ? AND servizio_id = ?
        ', [$associazione['id'], $servizio['id']]);
        return count($result) > 0;
    }
    
    public static function addGiorni(Servizio $servizio, $giorni)
    {
        DB::delete('DELETE FROM servizio_has_giorno WHERE servizio_id = ?', [$servizio['id']]);
        foreach($giorni as $giorno){
            /*$day = $giorno->data;
            while($day->lte($servizio->data_fine)){
                self::addGiorno($servizio, $day, $giorno->da, $giorno->a, $giorno->descrizione);
                $day = self::getNextPeriodicalDate($servizio, $day);
            }*/
            self::addGiorno($servizio, $giorno->data, $giorno->da, $giorno->a, $giorno->descrizione);
        }
    }
    
    public static function getNextPeriodicalDate(Servizio $servizio, $day)
    {
        if(empty($servizio)) return null;
        return $servizio->getNextPeriodicalDate($day);
    }
    
    public static function addGiorno(Servizio $servizio, $giorno, $da, $a, $descrizione)
    {
        DB::insert('INSERT IGNORE INTO servizio_has_giorno (servizio_id, giorno, da, a, descrizione) VALUES(?,?,?,?,?)', array($servizio->id, $giorno, $da, $a, $descrizione));
    }
    
    public static function addAssociazione(Servizio $servizio, Associazione $associazione, $creatore)
    {
        DB::insert('INSERT IGNORE INTO associazione_has_servizio (associazione_id, servizio_id, creatore) VALUES(?,?,?)', array($associazione->id, $servizio->id, $creatore));
    }
    
    public static function deleteById($id)
    {
        $servizio = self::getById($id);
        if(empty($servizio)){
            return false;
        }
        return self::delete($servizio);
    }
    
    public static function delete(Servizio $servizio)
    {
        FileRepository::deleteById($servizio->logo);
        DB::delete('DELETE FROM servizio_has_giorno WHERE servizio_id = ?', [$servizio['id']]);
        DB::delete('DELETE FROM servizio WHERE id = ?', [$servizio['id']]);
        return true;
    }
    
    public static function getLogoBase64(Servizio $servizio)
    {
        if(empty($servizio)) return null;
        $logo = FileRepository::getById($servizio->logo);
        if(empty($logo)) return null;
        return FileRepository::getBase64Uri($logo);
    }
    
}