<?php

namespace Samarete\Http\Controllers;

use Samarete\Http\Requests\ViewProgettoRequest;
use Samarete\Http\Requests\SaveProgettoRequest;
use Samarete\Http\Requests\InvitaProgettoRequest;
use Samarete\Http\Requests\DeleteProgettoRequest;
use Samarete\Http\Requests\EditProgettoRequest;
use Samarete\Http\Requests\FileProgettoRequest;
use Samarete\Http\Requests\PublishFileProgettoRequest;
use Samarete\Http\Requests\ConfirmFileProgettoRequest;

use Samarete\Repositories\FileRepository;
use Samarete\Repositories\ProgettoRepository;
use Samarete\Repositories\AssociazioneRepository;
use Samarete\Repositories\ChatRepository;

use Samarete\Models\Progetto;
use Samarete\Models\User;
use Samarete\Models\File;

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
    
    public function invita(InvitaProgettoRequest $request)
    {
        $progetto = $this->progetti->getById($request->progetto);
        $this->authorize('invite', $progetto);
        foreach($request->associazioni as $associazione_id){
            $associazione = AssociazioneRepository::getById($associazione_id);
            ProgettoRepository::addAssociazione($progetto, $associazione, 0);
        }
        return response()->json(["status" => 200, "message" => "OK"]);
    }
    
    public function confirmFile(ConfirmFileProgettoRequest $request)
    {
        $progetto = $this->progetti->getById($request->progetto_id);
        if(empty((array)$progetto))
            return response()->json(array("status" => 400, "message" => "ERROR"));
        $this->authorize('uploadFile', $progetto);
        
        foreach(explode(',', $request->file_ids) as $fileid){
            $file = FileRepository::confirmFileById(Auth::user(), intval($fileid));
            if(empty($file)) continue;
            $this->progetti->addFile($progetto, $file);
        }
        
        return response()->json(["status" => 200, "message" => "OK"]);
    }
    
    public function publishFile(PublishFileProgettoRequest $request)
    {
        $progetto = $this->progetti->getById($request->progetto_id);
        $file = FileRepository::getById($request->file_id);
        if(empty($file) || empty((array)$progetto))
            return response()->json(array("status" => 400, "message" => "ERROR"));
        $this->authorize('publishFile', $progetto);
        if(!isset($request->public)){
            $public = 0;
        }else{
            $public = $request->public;
        }
        $this->progetti->publishFile($progetto, $file, $public);
        return response()->json(["status" => 200, "message" => "OK"]);
    }
    
    public function deleteFile(FileProgettoRequest $request)
    {
        $progetto = $this->progetti->getById($request->progetto_id);
        $file = FileRepository::getById($request->file_id);
        if(empty($file) || empty((array)$progetto))
            return response()->json(array("status" => 400, "message" => "ERROR"));
        $this->authorize('deleteFile', $progetto, $file);
        $this->progetti->deleteFile($progetto, $file);
        return response()->json(["status" => 200, "message" => "OK"]);
    }
    
    public function downloadFile(FileProgettoRequest $request)
    {
        $progetto = $this->progetti->getById($request->progetto_id);
        $file = FileRepository::getById($request->file_id);
        if(empty($file) || empty((array)$progetto))
            return response()->json(array("status" => 400, "message" => "ERROR"));
        $this->authorize('downloadFile', $progetto, $file);
        $pathToFile = FileRepository::getCompleteFilePath($file);
        return response()->download(storage_path("app/data/".$pathToFile), $file->nome_originale);
    }
    
    public function viewProgetto(ViewProgettoRequest $request)
    {
        $progetto = $request->progetto();
        if(empty((array)$progetto)) redirect('/progetti');
        return response()->view('progetti.view', ['progetto' => $progetto, 'associazioni' => ProgettoRepository::getAvailableAssociazioni($progetto)]);
    }
    
    public function editProgetto(EditProgettoRequest $request)
    {
        $progetto = $request->progetto();
        if($progetto)
            $this->authorize('create', Progetto::class);
        else
            $this->authorize('update', $progetto);
        $this->associazione = Auth::user()->associazione();
        return response()->view('progetti.edit', ['associazione' => $this->associazione,'progetto' => is_object($progetto) ? $progetto : null]);
    }
    
    public function getFiles(ViewProgettoRequest $request)
    {
        $progetto = $request->progetto();
        $onlypublic = empty(Auth::user()) || !Auth::user()->can('update', $progetto);
        return response()->json($this->progetti->getFilesWithSideInfo($progetto, $onlypublic));
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
        return response()->json(["status" => 200, "message" => "OK"]);
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
