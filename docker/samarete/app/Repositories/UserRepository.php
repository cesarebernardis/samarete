<?php

namespace Samarete\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Samarete\Repositories\RuoloRepository;
use Samarete\Repositories\PermessoRepository;

use Samarete\Models\User;
use Samarete\Models\Ruolo;
use Samarete\Models\Associazione;

class UserRepository
{
    public static function getAll()
    {
        return User::all();
    }
    
    public static function getAttivi()
    {
        return User::where('attivo', 1)->get();
    }
    
    public static function getByUsername($username)
    {
        return User::where('username', $username)->first();
    }
    
    public static function getByEmail($email)
    {
        return User::where('email', $email)->first();
    }
    
    public static function getById($id)
    {
        return User::where('id', $id)->first();
    }
    
    public static function getRuoliUsers()
    {
        $result = DB::select('
            SELECT ur.*, r.nome as ruolo_nome, CONCAT(u.nome, " ", u.cognome) as user_nome 
            FROM user_has_ruolo ur 
            JOIN ruolo r ON r.id = ur.ruolo_id 
            JOIN users u ON u.id = ur.user_id');
        return $result;
    }
    
    public static function checkUsername($username, $id)
    {
        $user = self::getByUsername($username);
        if(!empty($user)){
            if(!empty($id)){
                $user1 = self::getById($id);
                if($user['id'] != $user1['id']){
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
        $user = self::getById($id);
        if(empty($user)){
            return false;
        }
        return self::delete($user);
    }
    
    public static function delete(User $user)
    {
        DB::delete('DELETE FROM user_has_ruolo WHERE user_id = ?', [$user['id']]);
        DB::delete('DELETE FROM user WHERE id = ?', [$user['id']]);
        return true;
    }
    
    public static function addRuolo(User $user, Ruolo $ruolo)
    {
        if(empty(DB::select('SELECT * FROM user_has_ruolo WHERE user_id = ? AND ruolo_id = ?', [$user['id'], $ruolo['id']]))){
            DB::insert('INSERT INTO user_has_ruolo (user_id, ruolo_id) VALUES (?, ?)', [$user['id'], $ruolo['id']]);
        }
    }
    
    public static function revokeRuolo(User $user, Ruolo $ruolo)
    {
        DB::delete('DELETE FROM user_has_ruolo WHERE user_id = ? AND ruolo_id = ?', [$user['id'], $ruolo['id']]);
    }
    
    public static function isAdmin(User $user = null)
    {
        if(empty($user)){
            $user = Auth::user();
        }
        if(empty($user)) return false;
        
        return $user->admin == 1;
    }
    
    public static function checkPermesso(User $user, $permesso)
    {
        if(empty($user)){
            $user = Auth::user();
        }
        if(empty($user)) return false;
        
        if(self::isAdmin($user)) return true;
        
        $results = DB::select('
            SELECT * 
            FROM user_has_ruolo ur
            JOIN ruolo_has_permesso rp ON rp.ruolo_id = ur.ruolo_id
            JOIN permesso p ON p.id = rp.permesso_id
            WHERE ur.user_id = ? AND p.nome = ?', 
            [$user['id'], $permesso]);
        return count($results) > 0;
    }
    
    public static function hasRuolo(User $user, Ruolo $ruolo)
    {
        $results = DB::select('
            SELECT * 
            FROM user_has_ruolo
            WHERE user_id = ? AND ruolo_id = ?', 
            [$user['id'], $ruolo['id']]);
        return count($results) > 0;
    }
    
    public static function hasAssociazione(User $user, Associazione $associazione)
    {
        $results = DB::select('
            SELECT * 
            FROM associazione
            WHERE gestore_id = ? AND id = ?', 
            [$user['id'], $associazione['id']]);
        return count($results) > 0;
    }
    
    public static function checkPermessoAndAssociazione(User $user, Associazione $associazione, $permesso)
    {
        return self::checkPermesso($user, $permesso) && self::hasAssociazione($user, $associazione);
    }
    
}