<?php

namespace Samarete\Repositories;

use Illuminate\Support\Facades\DB;

use Samarete\Models\Progetto;
use Samarete\Models\Associazione;

use Samarete\Repositories\FileRepository;

class ProgettoRepository
{
    public static function getAll()
    {
        $progetti = array();
        foreach(Progetto::all() as $progetto){
            $progetto->logo_base64 = self::getLogoBase64($progetto);
            $progetti[] = $progetto;
        }
        return $progetti;
    }
    
    public static function getByNome($name)
    {
        $progetto = Progetto::where('nome', $name)->first();
        $progetto->logo_base64 = self::getLogoBase64($progetto);
        return $progetto;
    }
    
    public static function getById($id)
    {
        $progetto = Progetto::where('id', $id)->first();
        $progetto->logo_base64 = self::getLogoBase64($progetto);
        return $progetto;
    }
    
    public static function progettoHasAssociazione(Progetto $progetto, Associazione $associazione)
    {
        $result = DB::select('
            SELECT *
            FROM associazione_has_progetto
            WHERE associazione_id = ? AND progetto_id = ?
        ', [$associazione['id'], $progetto['id']]);
        return count($result) > 0;
    }
    
    public static function addAssociazione(Progetto $progetto, Associazione $associazione, $creatore)
    {
        DB::insert('INSERT IGNORE INTO associazione_has_progetto (associazione_id, progetto_id, creatore) VALUES(?,?,?)', array($associazione->id, $progetto->id, $creatore));
    }
    
    public static function deleteById($id)
    {
        $progetto = self::getById($id);
        if(empty($progetto)){
            return false;
        }
        return self::delete($progetto);
    }
    
    public static function delete(Progetto $progetto)
    {
        FileRepository::deleteById($progetto->logo);
        foreach($progetto->files() as $file){
            FileRepository::delete($file);
        }
        DB::delete('DELETE FROM progetto_has_file WHERE progetto_id = ?', [$progetto['id']]);
        DB::delete('DELETE FROM progetto WHERE id = ?', [$progetto['id']]);
        return true;
    }
    
    public static function getLogoBase64(Progetto $progetto)
    {
        if(empty($progetto)) return null;
        $logo = FileRepository::getById($progetto->logo);
        if(empty($logo)) return null;
        return FileRepository::getBase64Uri($logo);
    }
    
}