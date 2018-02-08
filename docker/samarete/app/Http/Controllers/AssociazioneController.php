<?php

namespace Samarete\Http\Controllers;

use Illuminate\Http\Request;
use Samarete\Http\Requests\SearchAssociazioneRequest;
use Samarete\Http\Requests\EditAssociazioneRequest;
use Samarete\Http\Requests\ViewAssociazioneRequest;
use Samarete\Http\Requests\SaveAssociazioneRequest;
use Samarete\Http\Requests\SaveFileRequest;
use Samarete\Http\Requests\DeleteAssociazioneRequest;
use Samarete\Http\Requests\ManagePermessoRequest;

use Illuminate\Http\UploadedFile;

use Samarete\Models\Associazione;

use Samarete\Repositories\AssociazioneRepository;
use Samarete\Repositories\UserRepository;
use Samarete\Repositories\FileRepository;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AssociazioneController extends Controller
{
    /**
     * The associazione repository instance.
     */
    protected $associazioni;

    /**
     * Create a new controller instance.
     *
     * @param  AssociazioneRepository  $associazioni
     * @return void
     */
    public function __construct(AssociazioneRepository $associazioni)
    {
        $this->associazioni = $associazioni;
    }
    
    public function index(SearchAssociazioneRequest $request)
    {
        $query = trim(strip_tags($request->search));
        $associazioni = $this->associazioni->getAll(strtolower($query));
        return response()->view('associazioni.index', ['associazioni' => $associazioni, 'query' => $query]);
    }
    
    public function viewAssociazione(ViewAssociazioneRequest $request)
    {
        $associazione = $request->associazione();
        if(empty($associazione)) redirect('/associazioni');
        return response()->view('associazioni.view', ['associazione' => $associazione]);
    }
    
    public function editAssociazione(EditAssociazioneRequest $request)
    {
        $associazione = $request->associazione();
        if($associazione)
            $this->authorize('create', Associazione::class);
        else
            $this->authorize('update', $associazione);
        $this->associazione = Auth::user()->associazione();
        
        $params = ['associazione' => $this->associazione,'associazione' => is_object($associazione) ? $associazione : null];
        if(Auth::user()->isAdmin())
            $params['users'] = UserRepository::getFree();
        return response()->view('associazioni.edit', $params);
    }
    
    public function getAssociazioni(Request $request)
    {
        $this->authorize('view', Associazione::class);
        return response()->json($this->associazioni->getAll());
    }
    
    public function getAssociazione(ViewAssociazioneRequest $request)
    {
        $associazione = $this->associazioni->getById($request->id);
        $this->authorize('view', $associazione);
        return response()->json($associazione);
    }
    
    public function getLogo(ViewAssociazioneRequest $request)
    {
        $associazione = $this->associazioni->getById($request->id);
        $this->authorize('view', $associazione);
        $logo = FileRepository::getById($associazione->logo);
        if(empty($logo)){
            return '';
        }
        return response()->json(['filename' => $logo->nome_originale, 'content' => FileRepository::getBase64Uri($logo)]);
    }
    
    public function checkNome(Request $request)
    {
        $this->authorize('create', Associazione::class);
        $nome = $request->nome;
        $id = $request->id;
        $result = $this->associazioni->checkNome($nome, $id);
        return $result ? 'true' : 'false';
    }
    
    public function toggleAssociazione(DeleteAssociazioneRequest $request)
    {
        $associazione = $this->associazioni->getById($request->id);
        $this->authorize('edit', $associazione);
        $associazione->attivo = !$associazione->attivo;
        $associazione->save();
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function deleteAssociazione(DeleteAssociazioneRequest $request)
    {
        $associazione = $this->associazioni->getById($request->id);
        $this->authorize('delete', $associazione);
        $this->associazioni->delete($associazione);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function saveAssociazione(SaveAssociazioneRequest $request)
    {
        $associazione = new Associazione;
        if(!empty($request->id)){
            $associazione = AssociazioneRepository::getById($request->id);
            if(empty($associazione))
                return response()->json(array("status" => 400, "message" => "ID Associazione non valido"));
            $this->authorize('edit', $associazione);
        }else{
            $this->authorize('create', Associazione::class);
            $associazione->data_creazione = new \DateTime();
        }
        $associazione->nome = $request->nome;
        $associazione->acronimo = $request->acronimo;
        $associazione->indirizzo = $request->indirizzo;
        $associazione->telefono_1 = $request->telefono_1;
        $associazione->telefono_2 = $request->telefono_2;
        $associazione->referente_nome = $request->referente_nome;
        $associazione->referente_indirizzo = $request->referente_indirizzo;
        $associazione->referente_telefono_1 = $request->referente_telefono_1;
        $associazione->referente_telefono_2 = $request->referente_telefono_2;
        $associazione->email = $request->email;
        $associazione->sito_web = $request->sito_web;
        $associazione->descrizione = $request->descrizione;
        if(Auth::user()->isAdmin()){
            $associazione->gestore_id = $request->gestore_id;
        }
        $associazione->save();
        if (!empty($request->new_logo)) {
            $file = FileRepository::getTmpById($request->new_logo);
            if(!empty($file)){
                $logo = FileRepository::confirmFile(UserRepository::getById($associazione->gestore_id), $file);
                $associazione->update(['logo' => $logo->id]);
            }
        }
        $user = UserRepository::getById($associazione->gestore_id);
        if($user) $user->update(['associazione_id' => $associazione->id]);
        return response()->json(array("status" => 200, "message" => "OK", "associazioneid" => $associazione->id));
    }
}
