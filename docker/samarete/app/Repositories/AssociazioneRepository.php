<?php

namespace Samarete\Repositories;

use Illuminate\Support\Facades\DB;

use Samarete\Models\User;
use Samarete\Models\Associazione;
use Samarete\Models\Permesso;

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
    
}