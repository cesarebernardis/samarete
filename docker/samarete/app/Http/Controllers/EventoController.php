<?php

namespace Samarete\Http\Controllers;

use Samarete\Http\Requests\SearchEventoRequest;
use Samarete\Http\Requests\ViewEventoRequest;
use Samarete\Http\Requests\SaveEventoRequest;
use Samarete\Http\Requests\DeleteEventoRequest;
use Samarete\Http\Requests\EditEventoRequest;

use Samarete\Repositories\FileRepository;
use Samarete\Repositories\EventoRepository;
use Samarete\Repositories\AssociazioneRepository;

use Samarete\Models\Evento;
use Samarete\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * The evento repository instance.
     */
    protected $eventi;
    protected $associazione;

    /**
     * Create a new controller instance.
     *
     * @param  EventoRepository  $eventi
     * @return void
     */
    public function __construct(EventoRepository $eventi)
    {
        $this->eventi = $eventi;
    }
    
    public function index(SearchEventoRequest $request)
    {
        $query = trim(strip_tags($request->search));
        $eventi = $this->eventi->getAll(strtolower($query));
        $prossimi_eventi = $this->eventi->getProssimi();
        return response()->view('eventi.index', ['eventi' => $eventi, 'query' => $query, 'page' => $request->page, 'prossimi_eventi' => $prossimi_eventi]);
    }
    
    public function viewEvento(ViewEventoRequest $request)
    {
        $evento = $request->evento();
        if(empty($evento)) redirect('/eventi');
        return response()->view('eventi.view', ['evento' => $evento]);
    }
    
    public function editEvento(EditEventoRequest $request)
    {
        $evento = $request->evento();
        if($evento)
            $this->authorize('create', Evento::class);
        else
            $this->authorize('update', $evento);
        $this->associazione = Auth::user()->associazione();
        return response()->view('eventi.edit', ['associazione' => $this->associazione,'evento' => is_object($evento) ? $evento : null]);
    }
    
    
    
    public function getEventi(SearchEventoRequest $request)
    {
        $query = trim(strip_tags($request->search));
        $eventi = $this->eventi->getAll(strtolower($query));
        if(isset($request->page)){
            $eventi = array_slice($eventi, ($request->page - 1) * 9, 9, true);
        }
        return response()->json($eventi);
    }
    
    public function getEvento(ViewEventoRequest $request)
    {
        $evento = $request->evento();
        return response()->json($evento);
    }
    
    public function getLogo(ViewEventoRequest $request)
    {
        $evento = $this->eventi->getById($request->id);
        $this->authorize('view', $evento);
        $logo = FileRepository::getById($evento->logo);
        if(empty($logo)){
            return '';
        }
        return response()->json(['filename' => $logo->nome_originale, 'content' => FileRepository::getBase64Uri($logo)]);
    }
    
    public function deleteEvento(DeleteEventoRequest $request)
    {
        $evento = $request->evento();
        $this->authorize('delete', $evento);
        $this->eventi->deleteById($request->id);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function saveEvento(SaveEventoRequest $request)
    {
        $evento = new Evento;
        $creatore = 0;
        if(!empty($request->id)){
            $evento = Evento::where('id', $request->id)->first();
            $this->authorize('update', $evento);
        }else{
            $this->authorize('create', Evento::class);
            $evento->data_creazione = new \DateTime();
            $creatore = 1;
        }
        $evento->nome = $request->nome;
        $evento->oggetto = $request->oggetto;
        $evento->descrizione = $request->descrizione;
        $evento->luogo = $request->luogo;
        $evento->logo = $request->logo;
        $associazione = AssociazioneRepository::getById($request->creatore_id);
        if(!empty($request->new_logo)){
            $file = FileRepository::confirmFile($associazione, FileRepository::getTmpById($request->new_logo));
            $evento->logo = $file['id'];
        }
        $evento->save();
        $giorni = $this->formatGiorniFormData($request->giorno);
        $this->eventi->addGiorni($evento, $giorni);
        $this->eventi->addAssociazione($evento, $associazione, $creatore);
        return response()->json(array("status" => 200, "message" => "OK", "eventoid" => $evento->id));
    }
    
    private function formatGiorniFormData($giorni)
    {
        $parsed = array();
        for($i = 0; $i < count($giorni['data']); $i++){
            $g = new \stdClass();
            $g->data = date_create_from_format('d/m/Y', $giorni['data'][$i]);
            $g->da = date_create_from_format('H:i', $giorni['da'][$i]);
            $g->a = date_create_from_format('H:i', $giorni['a'][$i]);
            $g->descrizione = $giorni['descrizione'][$i];
            $parsed[$i] = $g;
        }
        return $parsed;
    }
}
