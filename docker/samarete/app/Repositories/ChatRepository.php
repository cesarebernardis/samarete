<?php

namespace Samarete\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Samarete\Repositories\RuoloRepository;
use Samarete\Repositories\PermessoRepository;

use Samarete\Models\Chat;
use Samarete\Models\User;
use Samarete\Models\Associazione;
use Samarete\Models\Messaggio;

class ChatRepository
{
    public static function getAll()
    {
        return Chat::all();
    }
    
    public static function getById($id)
    {
        return Chat::where('id', $id)->first();
    }
    
    public static function deleteById($id)
    {
        $chat = self::getById($id);
        if(empty($chat)){
            return false;
        }
        return self::delete($chat);
    }
    
    public static function create(Associazione $associazione)
    {
        $chat = new Chat;
        $chat->data_creazione = new \Datetime();
        $chat->save();
        self::addAssociazione($chat, $associazione);
        return $chat;
    }
    
    public static function delete(Chat $chat)
    {
        DB::delete('DELETE FROM messaggio WHERE chat_id = ?', [$chat['id']]);
        DB::delete('DELETE FROM chat_has_associazione WHERE chat_id = ?', [$chat['id']]);
        DB::delete('DELETE FROM chat WHERE id = ?', [$chat['id']]);
        return true;
    }
    
    public static function addAssociazione(Chat $chat, Associazione $associazione)
    {
        DB::insert('INSERT IGNORE INTO chat_has_associazione (chat_id, associazione_id) VALUES (?, ?)', [$chat['id'], $associazione['id']]);
    }
    
    public static function removeAssociazione(Chat $chat, Associazione $associazione)
    {
        DB::delete('DELETE FROM chat_has_associazione WHERE chat_id = ? AND associazione_id = ?', [$chat['id'], $associazione['id']]);
    }
    
    public static function chatHasAssociazione(Chat $chat, Associazione $associazione)
    {
        $result = DB::select('
            SELECT *
            FROM chat_has_associazione
            WHERE associazione_id = ? AND chat_id = ?
        ', [$associazione['id'], $chat['id']]);
        return count($result) > 0;
    }
    
    public static function saveMessaggio(Chat $chat, $text)
    {
        $message = new Messaggio;
        $message->chat_id = $chat->id;
        $message->autore_id = Auth::user()->associazione()->id;
        $message->data = new \Datetime();
        $message->testo = $text;
        $message->save();
        return $message;
    }
    
}