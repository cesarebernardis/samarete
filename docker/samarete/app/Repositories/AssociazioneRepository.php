<?php

namespace Samarete\Repositories;

use Illuminate\Support\Facades\DB;

use Samarete\Models\User;
use Samarete\Models\Associazione;
use Samarete\Models\Permesso;
use Samarete\Models\File;

use Samarete\Repositories\FileRepository;

class AssociazioneRepository
{
    public static function getAll($query = '')
    {
        $associazioni = array();
        $a = new Associazione;
        if(!empty($query)){
            $query = '%'.$query.'%';
            $a = $a->whereRaw('LOWER(nome) LIKE ?', [$query])->orWhereRaw('LOWER(acronimo) LIKE ?', [$query])->orWhereRaw('LOWER(descrizione) LIKE ?', [$query])->orWhereRaw('LOWER(email) LIKE ?', [$query])->get();
        }else{
            $a = $a->all();
        }
        foreach($a as $associazione){
            $associazione->logo_base64 = self::getLogoBase64($associazione);
            $associazioni[] = $associazione;
        }
        return $associazioni;
    }
    
    public static function getActive($query = '')
    {
        $associazioni = array();
        $a = Associazione::where('attivo', 1);
        if(!empty($query)){
            $query = '%'.$query.'%';
            $a = $a->whereRaw('LOWER(nome) LIKE ?', [$query])->orWhereRaw('LOWER(acronimo) LIKE ?', [$query])->orWhereRaw('LOWER(descrizione) LIKE ?', [$query])->orWhereRaw('LOWER(email) LIKE ?', [$query])->get();
        }else{
            $a = $a->get();
        }
        foreach($a as $associazione){
            $associazione->logo_base64 = self::getLogoBase64($associazione);
            $associazioni[] = $associazione;
        }
        return $associazioni;
    }
    
    public static function getByNome($name)
    {
        $associazione = Associazione::where('nome', $name)->first();
        if(empty($associazione)) return null;
        $associazione->logo_base64 = self::getLogoBase64($associazione);
        return $associazione;
    }
    
    public static function getById($id)
    {
        $associazione = Associazione::where('id', $id)->first();
        if(empty($associazione)) return null;
        $associazione->logo_base64 = self::getLogoBase64($associazione);
        return $associazione;
    }
    
    public static function checkNome($nome, $id='')
    {
        $associazione = self::getByNome($nome);
        if(!empty($associazione)){
            if(!empty($id)){
                $associazione1 = self::getById($id);
                if($associazione['id'] != $associazione1['id']){
                    return false;
                }
            }else{
                return false;
            }
        }
        return true;
    }
    
    public static function deleteById($id)
    {
        $associazione = self::getById($id);
        if(empty($associazione)){
            return false;
        }
        return self::delete($associazione);
    }
    
    public static function delete(Associazione $associazione)
    {
        FileRepository::deleteById($associazione->logo);
        DB::delete('DELETE FROM associazione WHERE id = ?', [$associazione['id']]);
        return true;
    }
    
    public static function getLogoBase64(Associazione $associazione)
    {
        if(empty($associazione)) return null;
        $logo = FileRepository::getById($associazione->logo);
        if(empty($logo)) return null;
        return FileRepository::getBase64Uri($logo);
    }
    
    public static function addFile(Associazione $associazione, File $file, $public=false)
    {
        DB::insert('INSERT IGNORE INTO associazione_has_file (associazione_id, file_id, public) VALUES(?,?,?)', array($associazione->id, $file->id, $public));
    }
    
    public static function publishFile(Associazione $associazione, File $file, $public=true)
    {
        if(empty($associazione) || empty($file)) return null;
        DB::table('associazione_has_file')->where('associazione_id', $associazione->id)->where('file_id', $file->id)->update(['public' => $public]);
        return true;
    }
    
    public static function deleteFile(Associazione $associazione, File $file)
    {
        if(empty($associazione) || empty($file)) return null;
        DB::delete('DELETE FROM associazione_has_file WHERE associazione_id = ? AND file_id = ?', [$associazione->id, $file->id]);
        FileRepository::delete($file);
        return true;
    }
    
    public static function getFilesWithSideInfo(Associazione $associazione, $onlypublic = false)
    {
        if(empty($associazione)) return array();
        $files = array();
        foreach($associazione->files as $file){
            $file->public = $file->pivot->public;
            if($onlypublic && $file->public < 1) continue;
            $files[] = $file;
        }
        return $files;
    }
    
}