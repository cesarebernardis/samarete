<?php

namespace Samarete\Http\Controllers;

use Illuminate\Http\Request;
use Samarete\Http\Requests\ViewChatRequest;
use Samarete\Http\Requests\SaveChatRequest;
use Samarete\Http\Requests\SaveMessaggioRequest;
use Samarete\Http\Requests\DeleteChatRequest;

use Samarete\Models\Chat;

use Samarete\Repositories\ChatRepository;
use Samarete\Repositories\UserRepository;
use Samarete\Repositories\AssociazioneRepository;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class ChatController extends Controller
{
    /**
     * The chat repository instance.
     */
    protected $chats;

    /**
     * Create a new controller instance.
     *
     * @param  ChatRepository  $chats
     * @return void
     */
    public function __construct(ChatRepository $chats)
    {
        $this->chats = $chats;
    }
    
    public function getChats(Request $request)
    {
        $this->authorize('view', Chat::class);
        return response()->json($this->chats->getAll());
    }
    
    public function getChat(ViewChatRequest $request)
    {
        $chat = $request->chat();
        $this->authorize('view', $chat);
        return response()->json($chat);
    }
    
    public function getMessaggi(ViewChatRequest $request)
    {
        $chat = $request->chat();
        $this->authorize('view', $chat);
        $messaggi = array();
        foreach($chat->messaggi as $messaggio){
            $messaggi[] = array(
                'id' => $messaggio->id,
                'autore' => empty($messaggio->autore->acronimo) ? $messaggio->autore->nome : $messaggio->autore->acronimo,
                'data' => $messaggio->data->formatLocalized('%d/%m/%Y %H:%M'),
                'testo' => $messaggio->testo,
                'chat_id' => $messaggio->chat_id,
            );
            
        }
        return response()->json(array("messaggi" => $messaggi));
    }
    
    public function deleteChat(DeleteChatRequest $request)
    {
        $chat = $request->chat();
        $this->authorize('delete', $chat);
        $this->chats->delete(trim(strip_tags($request->id)));
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function saveChat(SaveChatRequest $request)
    {
        $chat = new Chat;
        if(!empty($request->id)){
            $chat = $request->chat();
            if(empty($chat))
                return response()->json(array("status" => 400, "message" => "ID Chat non valido"));
            $this->authorize('update', $chat);
        }else{
            $this->authorize('create', Chat::class);
            $chat->data_creazione = new \DateTime();
        }
        $chat->save();
        return response()->json(array("status" => 200, "message" => "OK", "chat_id" => $chat->id));
    }
    
    public function saveMessaggio(SaveMessaggioRequest $request)
    {
        $chat = $this->chats->getById($request->chat);
        $this->authorize('send-message', $chat);
        $messaggio = $this->chats->saveMessaggio($chat, $request->messaggio);
        return response()->json(array(
            "status" => 200, 
            "message" => "OK", 
            'autore' => empty($messaggio->autore->acronimo) ? $messaggio->autore->nome : $messaggio->autore->acronimo,
            'data' => $messaggio->data->formatLocalized('%d/%m/%Y %H:%M'),
            'testo' => $messaggio->testo,
        ));
    }
}
