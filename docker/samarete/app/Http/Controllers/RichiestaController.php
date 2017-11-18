<?php

namespace Samarete\Http\Controllers;

use Samarete\Http\Requests\ViewRichiestaRequest;
use Samarete\Http\Requests\SaveRichiestaRequest;
use Samarete\Http\Requests\DeleteRichiestaRequest;
use Samarete\Http\Requests\EditRichiestaRequest;

use Samarete\Repositories\FileRepository;
use Samarete\Repositories\RichiestaRepository;
use Samarete\Repositories\AssociazioneRepository;

use Samarete\Models\Richiesta;
use Samarete\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class RichiestaController extends Controller
{
    /**
     * The richiesta repository instance.
     */
    protected $richieste;
    protected $associazione;

    /**
     * Create a new controller instance.
     *
     * @param  RichiestaRepository  $richieste
     * @return void
     */
    public function __construct(RichiestaRepository $richieste)
    {
        $this->richieste = $richieste;
    }
    
    public function index(Request $request)
    {
        $this->authorize('view', Richiesta::class);
        $associazione = Auth::user()->associazioni()->first();
        return response()->view('richieste.index', ['richieste' => $associazione->richieste()]);
    }
    
    public function newRichiesta(Request $request)
    {
        return response()->view('richieste.new', ['associazioni' => AssociazioneRepository::getActive()]);
    }
    
    public function viewRichiesta(ViewRichiestaRequest $request)
    {
        $richiesta = $request->richiesta();
        if(empty($richiesta)) redirect('/richieste');
        return response()->view('richieste.view', ['richiesta' => $richiesta]);
    }
    
    public function evadiRichiesta(ViewRichiestaRequest $request)
    {
        $richiesta = $request->richiesta();
        if(empty($richiesta)) response()->json(array("status" => 404, "message" => "NOT FOUND"));
        $this->richieste->evadiRichiesta($richiesta, Auth::user()->associazioni()->first());
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function getRichieste(Request $request)
    {
        $this->authorize('view', Richiesta::class);
        $associazione = Auth::user()->associazioni()->first();
        return response()->json($associazione->richieste());
    }
    
    public function getRichiesta(ViewRichiestaRequest $request)
    {
        $richiesta = $request->richiesta();
        $this->authorize('update', $richiesta);
        return response()->json($richiesta);
    }
    
    public function deleteRichiesta(DeleteRichiestaRequest $request)
    {
        $richiesta = $request->richiesta();
        $this->authorize('delete', $richiesta);
        $this->richieste->deleteById($request->id);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function saveRichiesta(SaveRichiestaRequest $request)
    {
        $richiesta = new Richiesta;
        if(!empty($request->id)){
            $richiesta = Richiesta::where('id', $request->id)->first();
            $this->authorize('update', $richiesta);
        }else{
            $richiesta->data_creazione = new \DateTime();
        }
        $richiesta->contatto_1 = $request->contatto_1;
        $richiesta->contatto_2 = $request->contatto_2;
        $richiesta->oggetto = $request->oggetto;
        $richiesta->testo = $request->testo;
        if(!isset($request->globale)){
            $richiesta->globale = 0;
        }else{
            $richiesta->globale = $request->globale;
        }
        $richiesta->save();
        if(isset($request->associazioni)){
            foreach($request->associazioni as $associazioneid){
                $this->richieste->addAssociazione($richiesta, AssociazioneRepository::getById($associazioneid));
            }
        }
        return response()->json(array("status" => 200, "message" => "OK", "richiestaid" => $richiesta->id));
    }
    
}
