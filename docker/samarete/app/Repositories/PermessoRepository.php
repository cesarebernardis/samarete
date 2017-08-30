<?php

namespace Samarete\Repositories;

use Illuminate\Support\Facades\DB;

use Samarete\Models\Permesso;

class PermessoRepository
{
    public function getAll()
    {
        return Permesso::all();
    }
    
    public function getByNome($name)
    {
        return Permesso::where('nome', $name)->first();
    }
    
    public function getById($id)
    {
        return Permesso::where('id', $id)->first();
    }
    
    public function checkNome($nome, $id='')
    {
        $permesso = self::getByNome($nome);
        if(!empty($permesso)){
            if(!empty($id)){
                $permesso1 = self::getById($id);
                if($permesso['id'] != $permesso1['id']){
                    return false;
                }
            }else{
                return false;
            }
        }
        return true;
    }
    
    public function deleteById($id)
    {
        $permesso = self::getById($id);
        if(empty($permesso)){
            return false;
        }
        return self::delete($permesso);
    }
    
    public function delete(Permesso $permesso)
    {
        DB::delete('DELETE FROM ruolo_has_permesso WHERE permesso_id = ?', [$permesso['id']]);
        DB::delete('DELETE FROM permesso WHERE id = ?', [$permesso['id']]);
        return true;
    }
    
}