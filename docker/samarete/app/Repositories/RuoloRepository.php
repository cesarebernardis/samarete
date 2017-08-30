<?php

namespace Samarete\Repositories;

use Illuminate\Support\Facades\DB;

use Samarete\Models\User;
use Samarete\Models\Ruolo;
use Samarete\Models\Permesso;

class RuoloRepository
{
    public static function getAll()
    {
        return Ruolo::all();
    }
    
    public static function getByNome($name)
    {
        return Ruolo::where('nome', $name)->first();
    }
    
    public static function getById($id)
    {
        return Ruolo::where('id', $id)->first();
    }
    
    public static function getAdmin()
    {
        return Ruolo::where('id', 1)->first();
    }
    
    public static function getPermessiRuoli()
    {
        $result = DB::select('
            SELECT ur.*, r.nome as ruolo_nome, u.nome as permesso_nome 
            FROM ruolo_has_permesso ur 
            JOIN ruolo r ON r.id = ur.ruolo_id 
            JOIN permesso u ON u.id = ur.permesso_id');
        return $result;
    }
    
    public static function checkNome($nome, $id='')
    {
        $ruolo = self::getByNome($nome);
        if(!empty($ruolo)){
            if(!empty($id)){
                $ruolo1 = self::getById($id);
                if($ruolo['id'] != $ruolo1['id']){
                    return false;
                }
            }else{
                return false;
            }
        }
        return true;
    }
    
    public static function addPermesso(Ruolo $ruolo, Permesso $permesso)
    {
        if(empty(DB::select('SELECT * FROM ruolo_has_permesso WHERE permesso_id = ? AND ruolo_id = ?', [$permesso['id'], $ruolo['id']]))){
            DB::insert('INSERT INTO ruolo_has_permesso (permesso_id, ruolo_id) VALUES (?, ?)', [$permesso['id'], $ruolo['id']]);
        }
    }
    
    public static function revokePermesso(Ruolo $ruolo, Permesso $permesso)
    {
        DB::delete('DELETE FROM ruolo_has_permesso WHERE permesso_id = ? AND ruolo_id = ?', [$permesso['id'], $ruolo['id']]);
    }
    
    public static function deleteById($id)
    {
        $ruolo = self::getById($id);
        if(empty($ruolo)){
            return false;
        }
        return self::delete($ruolo);
    }
    
    public static function delete(Ruolo $ruolo)
    {
        DB::delete('DELETE FROM ruolo_has_permesso WHERE ruolo_id = ?', [$ruolo['id']]);
        DB::delete('DELETE FROM ruolo WHERE id = ?', [$ruolo['id']]);
        return true;
    }
    
    public static function checkPermesso(Ruolo $ruolo, $permesso)
    {
        $results = DB::select('
            SELECT * 
            FROM ruolo_has_permesso rp
            JOIN permesso p ON p.id = rp.permesso_id
            WHERE rp.ruolo_id = ? AND p.nome = ?', 
            [$ruolo['id'], $permesso]);
        return count($results) > 0;
    }
    
}