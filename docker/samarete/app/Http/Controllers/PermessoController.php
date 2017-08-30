<?php

namespace Samarete\Http\Controllers;

use Samarete\Http\Requests\SavePermessoRequest;
use Samarete\Http\Requests\DeletePermessoRequest;

use Samarete\Repositories\PermessoRepository;

use Samarete\Models\Permesso;

use Illuminate\Http\Request;

class PermessoController extends Controller
{
    /**
     * The permesso repository instance.
     */
    protected $permessi;

    /**
     * Create a new controller instance.
     *
     * @param  PermessoRepository  $permessi
     * @return void
     */
    public function __construct(PermessoRepository $permessi)
    {
        $this->permessi = $permessi;
    }
    
    public function getPermessi(Request $request)
    {
        $this->authorize('view', Permesso::class);
        return response()->json($this->permessi->getAll());
    }
    
    public function checkNome(Request $request)
    {
        $this->authorize('create', Permesso::class);
        $nome = $request->nome;
        $id = $request->id;
        $result = $this->permessi->checkNome($nome, $id);
        return $result ? 'true' : 'false';
    }
    
    public function deletePermesso(DeletePermessoRequest $request)
    {
        $permesso = $this->permessi->getById($request->id);
        $this->authorize('delete', $permesso);
        $this->permessi->delete($permesso);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function savePermesso(SavePermessoRequest $request)
    {
        $permesso = new Permesso;
        if(!empty($request->id)){
            $permesso = PermessoRepository::getById($request->id);
            if(empty($permesso))
                return response()->json(array("status" => 400, "message" => "ID Permesso non valido"));
            $this->authorize('edit', $permesso);
        }else{
            $this->authorize('create', Permesso::class);
        }
        $permesso->nome = $request->nome;
        $permesso->save();
        return response()->json(array("status" => 200, "message" => "OK"));
    }
}
