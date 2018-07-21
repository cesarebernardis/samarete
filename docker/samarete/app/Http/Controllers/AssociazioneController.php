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

use Samarete\Http\Requests\FileAssociazioneRequest;
use Samarete\Http\Requests\PublishFileAssociazioneRequest;
use Samarete\Http\Requests\ConfirmFileAssociazioneRequest;

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
        return response()->view('associazioni.index', ['associazioni' => $associazioni, 'query' => $query, 'page' => $request->page]);
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
            $this->authorize('update', $associazione);
        else
            $this->authorize('create', Associazione::class);
        $this->associazione = Auth::user()->associazione();
        
        $params = ['associazione' => $this->associazione,'associazione' => is_object($associazione) ? $associazione : null];
        if(Auth::user()->isAdmin())
            $params['users'] = UserRepository::getFree();
        return response()->view('associazioni.edit', $params);
    }
    
    public function getAssociazioni(SearchAssociazioneRequest $request)
    {
        $query = trim(strip_tags($request->search));
        $associazioni = $this->associazioni->getAll(strtolower($query));
        if(isset($request->page)){
            $associazioni = array_slice($associazioni, ($request->page - 1) * 9, 9, true);
        }
        return response()->json($associazioni);
    }
    
    public function getAssociazione(ViewAssociazioneRequest $request)
    {
        $associazione = $this->associazioni->getById($request->id);
        $this->authorize('view', $associazione);
        return response()->json($associazione);
    }
    
    public function confirmFile(ConfirmFileAssociazioneRequest $request)
    {
        $associazione = $this->associazioni->getById($request->associazione_id);
        if(empty((array)$associazione))
            return response()->json(array("status" => 400, "message" => "ERROR"));
        $this->authorize('update', $associazione);
        
        foreach(explode(',', $request->file_ids) as $fileid){
            $file = FileRepository::confirmFileById(Auth::user(), intval($fileid));
            if(empty($file)) continue;
            $this->associazioni->addFile($associazione, $file);
        }
        
        return response()->json(["status" => 200, "message" => "OK"]);
    }
    
    public function publishFile(PublishFileAssociazioneRequest $request)
    {
        $associazione = $this->associazioni->getById($request->associazione_id);
        $file = FileRepository::getById($request->file_id);
        if(empty($file) || empty((array)$associazione))
            return response()->json(array("status" => 400, "message" => "ERROR"));
        $this->authorize('update', $associazione);
        if(!isset($request->public)){
            $public = 0;
        }else{
            $public = $request->public;
        }
        $this->associazioni->publishFile($associazione, $file, $public);
        return response()->json(["status" => 200, "message" => "OK"]);
    }
    
    public function deleteFile(FileAssociazioneRequest $request)
    {
        $associazione = $this->associazioni->getById($request->associazione_id);
        $file = FileRepository::getById($request->file_id);
        if(empty((array)$file) || empty((array)$associazione))
            return response()->json(array("status" => 400, "message" => "ERROR"));
        $this->authorize('update', $associazione);
        $this->associazioni->deleteFile($associazione, $file);
        return response()->json(["status" => 200, "message" => "OK"]);
    }
    
    public function downloadFile(FileAssociazioneRequest $request)
    {
        $associazione = $this->associazioni->getById($request->associazione_id);
        $file = FileRepository::getById($request->file_id);
        if(empty((array)$file) || empty((array)$associazione))
            return response()->json(array("status" => 400, "message" => "ERROR"));
        if(!$associazione->isPublic($file))
            $this->authorize('update', $associazione);
        $pathToFile = FileRepository::getCompleteFilePath($file);
        return response()->download(storage_path("app/data/".$pathToFile), $file->nome_originale);
    }
    
    public function getFiles(ViewAssociazioneRequest $request)
    {
        $associazione = $request->associazione();
        $onlypublic = empty(Auth::user()) || !Auth::user()->can('update', $associazione);
        return response()->json($this->associazioni->getFilesWithSideInfo($associazione, $onlypublic));
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
            $this->authorize('update', $associazione);
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
