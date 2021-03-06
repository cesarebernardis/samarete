<?php

namespace Samarete\Http\Controllers;

use Samarete\Http\Requests\SearchServizioRequest;
use Samarete\Http\Requests\ViewServizioCalendarRequest;
use Samarete\Http\Requests\ViewServizioRequest;
use Samarete\Http\Requests\SaveServizioRequest;
use Samarete\Http\Requests\DeleteServizioRequest;
use Samarete\Http\Requests\EditServizioRequest;

use Samarete\Repositories\FileRepository;
use Samarete\Repositories\ServizioRepository;
use Samarete\Repositories\AssociazioneRepository;

use Samarete\Models\Servizio;
use Samarete\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class ServizioController extends Controller
{
    /**
     * The servizio repository instance.
     */
    protected $servizi;
    protected $associazione;

    /**
     * Create a new controller instance.
     *
     * @param  ServizioRepository  $servizi
     * @return void
     */
    public function __construct(ServizioRepository $servizi)
    {
        $this->servizi = $servizi;
    }
    
    public function index(SearchServizioRequest $request)
    {
        $query = trim(strip_tags($request->search));
        $servizi = $this->servizi->getAll(strtolower($query));
        return response()->view('servizi.index', ['servizi' => $servizi, 'query' => $query]);
    }
    
    public function viewServizio(ViewServizioRequest $request)
    {
        $servizio = $request->servizio();
        if(empty($servizio)) redirect('/servizi');
        return response()->view('servizi.view', ['servizio' => $servizio]);
    }
    
    public function editServizio(EditServizioRequest $request)
    {
        $servizio = $request->servizio();
        if($servizio)
            $this->authorize('create', Servizio::class);
        else
            $this->authorize('update', $servizio);
        $this->associazione = Auth::user()->associazione();
        return response()->view('servizi.edit', ['associazione' => $this->associazione, 'servizio' => is_object($servizio) ? $servizio : null]);
    }
    
    public function getServizi(Request $request)
    {
        return response()->json($this->servizi->getAll());
    }
    
    public function getServizio(ViewServizioRequest $request)
    {
        $servizio = $request->servizio();
        return response()->json($servizio);
    }
    
    public function getLogo(ViewServizioRequest $request)
    {
        $servizio = $request->servizio();
        $this->authorize('view', $servizio);
        $logo = FileRepository::getById($servizio->logo);
        if(empty($logo)){
            return '';
        }
        return response()->json(['filename' => $logo->nome_originale, 'content' => FileRepository::getBase64Uri($logo)]);
    }
    
    public function getCalendar(ViewServizioCalendarRequest $request)
    {
        $servizio = $request->servizio();
        $giorni = [];
        foreach($servizio->getGiorni($request->start, $request->end) as $giorno){
            $obj = new \stdClass();
            $obj->title = $servizio->nome." - ".$giorno->descrizione;
            $obj->start = $giorno->giorno.'T'.$giorno->da;
            $obj->end = $giorno->giorno.'T'.$giorno->a;
            $giorni[] = $obj;
        }
        return response()->json($giorni);
    }
    
    public function deleteServizio(DeleteServizioRequest $request)
    {
        $servizio = $request->servizio();
        $this->authorize('delete', $servizio);
        $this->servizi->deleteById($request->id);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function saveServizio(SaveServizioRequest $request)
    {
        $servizio = new Servizio;
        $creatore = 0;
        if(!empty($request->id)){
            $servizio = Servizio::where('id', $request->id)->first();
            $this->authorize('update', $servizio);
        }else{
            $this->authorize('create', Servizio::class);
            $servizio->data_creazione = new \DateTime();
            $creatore = 1;
        }
        $servizio->nome = $request->nome;
        $servizio->oggetto = $request->oggetto;
        $servizio->descrizione = $request->descrizione;
        $servizio->luogo = $request->luogo;
        $servizio->periodicita = $request->periodicita;
        $servizio->data_fine = Carbon::createFromFormat('d/m/Y', $request->data_fine);
        $servizio->logo = $request->logo;
        $associazione = AssociazioneRepository::getById($request->creatore_id);
        if(!empty($request->new_logo)){
            $file = FileRepository::confirmFile($associazione, FileRepository::getTmpById($request->new_logo));
            $servizio->logo = $file['id'];
        }
        $servizio->save();
        $giorni = $this->formatGiorniFormData($request->giorno);
        $this->servizi->addGiorni($servizio, $giorni);
        $this->servizi->addAssociazione($servizio, $associazione, $creatore);
        return response()->json(array("status" => 200, "message" => "OK", "servizioid" => $servizio->id));
    }
    
    private function formatGiorniFormData($giorni)
    {
        $parsed = array();
        for($i = 0; $i < count($giorni['data']); $i++){
            if(empty($giorni['data'][$i])) continue;
            $g = new \stdClass();
            $g->data = Carbon::createFromFormat('d/m/Y', $giorni['data'][$i]);
            $g->da = Carbon::createFromFormat('H:i', $giorni['da'][$i]);
            $g->a = Carbon::createFromFormat('H:i', $giorni['a'][$i]);
            $g->descrizione = $giorni['descrizione'][$i];
            $parsed[$i] = $g;
        }
        return $parsed;
    }
}
