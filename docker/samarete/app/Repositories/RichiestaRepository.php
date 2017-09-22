<?php

namespace Samarete\Repositories;

use Illuminate\Support\Facades\DB;

use Samarete\Models\Richiesta;
use Samarete\Models\Associazione;

use Samarete\Repositories\FileRepository;

use Carbon\Carbon;

class RichiestaRepository
{
    public static function getAll()
    {
        $richieste = array();
        foreach(Richiesta::all() as $richiesta){
            $richieste[] = $richiesta;
        }
        return $richieste;
    }
    
    public static function getByNome($name, $showall = false)
    {
        $richiesta = Richiesta::where('nome', $name);
        if(!$showall) $richiesta = $richiesta->where('evasa_da', null);
        return $richiesta->first();
    }
    
    public static function getById($id, $showall = false)
    {
        $richiesta = Richiesta::where('id', $id);
        if(!$showall) $richiesta = $richiesta->where('evasa_da', null);
        return $richiesta->first();
    }
    
    public static function getGlobali($showall = false)
    {
        $richiesta = Richiesta::where('globale', 1);
        if(!$showall) $richiesta = $richiesta->where('evasa_da', null);
        return $richiesta->get();
    }
    
    public static function richiestaHasAssociazione(Richiesta $richiesta, Associazione $associazione)
    {
        $result = DB::select('
            SELECT *
            FROM richiesta_has_associazione
            WHERE associazione_id = ? AND richiesta_id = ?
        ', [$associazione['id'], $richiesta['id']]);
        return count($result) > 0;
    }
    
    public static function addAssociazione(Richiesta $richiesta, Associazione $associazione)
    {
        DB::insert('INSERT IGNORE INTO richiesta_has_associazione (associazione_id, richiesta_id) VALUES(?,?)', array($associazione->id, $richiesta->id));
    }
    
    public static function evadiRichiesta(Richiesta $richiesta, Associazione $associazione)
    {
        $richiesta->evasa_da = $associazione->id;
        $richiesta->data_evasione = Carbon::now();
        $richiesta->save();
    }
    
    public static function deleteById($id)
    {
        $richiesta = self::getById($id);
        if(empty($richiesta)){
            return false;
        }
        return self::delete($richiesta);
    }
    
    public static function delete(Richiesta $richiesta)
    {
        FileRepository::deleteById($richiesta->logo);
        DB::delete('DELETE FROM richiesta_has_associazione WHERE richiesta_id = ?', [$richiesta['id']]);
        DB::delete('DELETE FROM richiesta WHERE id = ?', [$richiesta['id']]);
        return true;
    }
    
}