<?php

namespace Samarete\Http\Controllers;

use Samarete\Http\Requests\ViewRuoloRequest;
use Samarete\Http\Requests\SaveRuoloRequest;
use Samarete\Http\Requests\DeleteRuoloRequest;
use Samarete\Http\Requests\ManagePermessoRequest;

use Samarete\Models\Ruolo;
use Samarete\Models\Permesso;

use Samarete\Repositories\RuoloRepository;
use Samarete\Repositories\PermessoRepository;

use Illuminate\Http\Request;

class RuoloController extends Controller
{
    /**
     * The ruolo repository instance.
     */
    protected $ruoli;

    /**
     * Create a new controller instance.
     *
     * @param  RuoloRepository  $ruoli
     * @return void
     */
    public function __construct(RuoloRepository $ruoli)
    {
        $this->ruoli = $ruoli;
    }
    
    public function getRuoli(Request $request)
    {
        $this->authorize('view', Ruolo::class);
        return response()->json($this->ruoli->getAll());
    }
    
    public function getRuolo(ViewRuoloRequest $request)
    {
        $ruolo = $this->ruoli->getById($request->id);
        $this->authorize('view', $ruolo);
        return response()->json($ruolo);
    }
    
    public function getPermessiRuoli(Request $request)
    {
        $this->authorize('update', Ruolo::class);
        return response()->json($this->ruoli->getPermessiRuoli());
    }
    
    public function checkNome(Request $request)
    {
        $this->authorize('create', Ruolo::class);
        $nome = $request->nome;
        $id = $request->id;
        $result = $this->ruoli->checkNome($nome, $id);
        return $result ? 'true' : 'false';
    }
    
    public function addPermesso(ManagePermessoRequest $request)
    {
        $permesso = PermessoRepository::getById($request->permesso_id);
        $ruolo = $this->ruoli->getById($request->ruolo_id);
        $this->authorize('addPermesso', $ruolo);
        if(empty($ruolo) || empty($permesso)){
            return response()->json(array("status" => 400, "message" => "ERROR"));
        }
        $this->ruoli->addPermesso($ruolo, $permesso);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function revokePermesso(ManagePermessoRequest $request)
    {
        $permesso = PermessoRepository::getById($request->permesso_id);
        $ruolo = $this->ruoli->getById($request->ruolo_id);
        $this->authorize('revokePermesso', $ruolo);
        if(empty($ruolo) || empty($permesso)){
            return response()->json(array("status" => 400, "message" => "ERROR"));
        }
        $this->ruoli->revokePermesso($ruolo, $permesso);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function toggleRuolo(DeleteRuoloRequest $request)
    {
        $ruolo = $this->ruoli->getById($request->id);
        $this->authorize('update', $ruolo);
        $ruolo->attivo = !$ruolo->attivo;
        $ruolo->save();
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function deleteRuolo(DeleteRuoloRequest $request)
    {
        $ruolo = $this->ruoli->getById($request->id);
        $this->authorize('delete', $ruolo);
        $this->ruoli->delete($ruolo);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function saveRuolo(SaveRuoloRequest $request)
    {
        $ruolo = new Ruolo;
        if(!empty($request->id)){
            $ruolo = RuoloRepository::getById($request->id);
            if(empty($ruolo))
                return response()->json(array("status" => 400, "message" => "ID Ruolo non valido"));
            $this->authorize('update', $ruolo);
        }else{
            $this->authorize('create', Ruolo::class);
            $ruolo->data_creazione = new \DateTime();
        }
        $ruolo->nome = $request->nome;
        $ruolo->save();
        return response()->json(array("status" => 200, "message" => "OK"));
    }
}
