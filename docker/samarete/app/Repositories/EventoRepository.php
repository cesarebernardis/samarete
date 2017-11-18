<?php

namespace Samarete\Repositories;

use Illuminate\Support\Facades\DB;

use Samarete\Models\Evento;
use Samarete\Models\Associazione;

use Samarete\Repositories\FileRepository;

class EventoRepository
{
    public static function getAll()
    {
        $eventi = array();
        foreach(Evento::all() as $evento){
            $evento->logo_base64 = self::getLogoBase64($evento);
            $evento->giorni = self::getGiorni($evento);
            $eventi[] = $evento;
        }
        return $eventi;
    }
    
    public static function getByNome($name)
    {
        $evento = Evento::where('nome', $name)->first();
        $evento->logo_base64 = self::getLogoBase64($evento);
        $evento->giorni = self::getGiorni($evento);
        return $evento;
    }
    
    public static function getById($id)
    {
        $evento = Evento::where('id', $id)->first();
        $evento->logo_base64 = self::getLogoBase64($evento);
        $evento->giorni = self::getGiorni($evento);
        return $evento;
    }
    
    private static function getGiorni(Evento $evento)
    {
        $giorni = array();
        foreach($evento->eventoHasGiorni() as $giorno){
            $giorni[] = $giorno;
        }
        return $giorni;
    }
    
    public static function eventoHasAssociazione(Evento $evento, Associazione $associazione)
    {
        $result = DB::select('
            SELECT *
            FROM associazione_has_evento
            WHERE associazione_id = ? AND evento_id = ?
        ', [$associazione['id'], $evento['id']]);
        return count($result) > 0;
    }
    
    public static function addGiorni(Evento $evento, $giorni)
    {
        DB::delete('DELETE FROM evento_has_giorno WHERE evento_id = ?', [$evento['id']]);
        foreach($giorni as $giorno){
            self::addGiorno($evento, $giorno->data, $giorno->da, $giorno->a, $giorno->descrizione);
        }
    }
    
    public static function addGiorno(Evento $evento, $giorno, $da, $a, $descrizione)
    {
        DB::insert('INSERT IGNORE INTO evento_has_giorno (evento_id, giorno, da, a, descrizione) VALUES(?,?,?,?,?)', array($evento->id, $giorno, $da, $a, $descrizione));
    }
    
    public static function addAssociazione(Evento $evento, Associazione $associazione, $creatore)
    {
        DB::insert('INSERT IGNORE INTO associazione_has_evento (associazione_id, evento_id, creatore) VALUES(?,?,?)', array($associazione->id, $evento->id, $creatore));
    }
    
    public static function deleteById($id)
    {
        $evento = self::getById($id);
        if(empty($evento)){
            return false;
        }
        return self::delete($evento);
    }
    
    public static function delete(Evento $evento)
    {
        FileRepository::deleteById($evento->logo);
        DB::delete('DELETE FROM evento_has_giorno WHERE evento_id = ?', [$evento['id']]);
        DB::delete('DELETE FROM evento WHERE id = ?', [$evento['id']]);
        return true;
    }
    
    public static function getLogoBase64(Evento $evento)
    {
        if(empty($evento)) return null;
        $logo = FileRepository::getById($evento->logo);
        if(empty($logo)) return null;
        return FileRepository::getBase64Uri($logo);
    }
    
}