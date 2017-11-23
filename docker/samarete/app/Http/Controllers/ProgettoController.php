<?php

namespace Samarete\Http\Controllers;

use Samarete\Http\Requests\ViewProgettoRequest;
use Samarete\Http\Requests\SaveProgettoRequest;
use Samarete\Http\Requests\DeleteProgettoRequest;
use Samarete\Http\Requests\EditProgettoRequest;

use Samarete\Repositories\FileRepository;
use Samarete\Repositories\ProgettoRepository;
use Samarete\Repositories\AssociazioneRepository;
use Samarete\Repositories\ChatRepository;

use Samarete\Models\Progetto;
use Samarete\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProgettoController extends Controller
{
    /**
     * The progetto repository instance.
     */
    protected $progetti;
    protected $associazione;

    /**
     * Create a new controller instance.
     *
     * @param  ProgettoRepository  $progetti
     * @return void
     */
    public function __construct(ProgettoRepository $progetti)
    {
        $this->progetti = $progetti;
    }
    
    public function index(Request $request)
    {
        return response()->view('progetti.index', ['progetti' => $this->progetti->getAll()]);
    }
    
    public function viewProgetto(ViewProgettoRequest $request)
    {
        $progetto = $request->progetto();
        if(empty($progetto)) redirect('/progetti');
        return response()->view('progetti.view', ['progetto' => $progetto]);
    }
    
    public function editProgetto(EditProgettoRequest $request)
    {
        $progetto = $request->progetto();
        if($progetto)
            $this->authorize('create', Progetto::class);
        else
            $this->authorize('update', $progetto);
        $this->associazione = Auth::user()->associazione_id;
        return response()->view('progetti.edit', ['associazione' => $this->associazione,'progetto' => is_object($progetto) ? $progetto : null]);
    }
    
    public function getProgetti(Request $request)
    {
        return response()->json($this->progetti->getAll());
    }
    
    public function getProgetto(ViewProgettoRequest $request)
    {
        $progetto = $request->progetto();
        return response()->json($progetto);
    }
    
    public function getLogo(ViewProgettoRequest $request)
    {
        $progetto = $this->progetti->getById($request->id);
        $this->authorize('view', $progetto);
        $logo = FileRepository::getById($progetto->logo);
        if(empty($logo)){
            return '';
        }
        return response()->json(['filename' => $logo->nome_originale, 'content' => FileRepository::getBase64Uri($logo)]);
    }
    
    public function deleteProgetto(DeleteProgettoRequest $request)
    {
        $progetto = $request->progetto();
        $this->authorize('delete', $progetto);
        $this->progetti->deleteById($request->id);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function saveProgetto(SaveProgettoRequest $request)
    {
        $progetto = new Progetto;
        $creatore = 0;
        $associazione = AssociazioneRepository::getById($request->creatore_id);
        if(!empty($request->id)){
            $progetto = Progetto::where('id', $request->id)->first();
            $this->authorize('update', $progetto);
        }else{
            $this->authorize('create', Progetto::class);
            $progetto->data_creazione = new \DateTime();
            $progetto->chat_id = ChatRepository::create($associazione)->id;
            $creatore = 1;
        }
        $progetto->nome = $request->nome;
        $progetto->oggetto = $request->oggetto;
        $progetto->descrizione = $request->descrizione;
        $progetto->logo = $request->logo;
        if(!empty($request->new_logo)){
            $file = FileRepository::confirmFile($associazione, FileRepository::getTmpById($request->new_logo));
            $progetto->logo = $file['id'];
        }
        $progetto->save();
        $this->progetti->addAssociazione($progetto, $associazione, $creatore);
        return response()->json(array("status" => 200, "message" => "OK", "progettoid" => $progetto->id));
    }
    
}
