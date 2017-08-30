<?php

namespace Samarete\Http\Controllers;

use Samarete\Http\Requests\ViewFileRequest;
use Samarete\Http\Requests\SaveFileRequest;
use Samarete\Http\Requests\SaveMultipleFileRequest;
use Samarete\Http\Requests\SaveTmpFileRequest;
use Samarete\Http\Requests\DeleteFileRequest;
use Samarete\Http\Requests\ManagePermessoRequest;

use Samarete\Models\File;
use Samarete\Models\Permesso;
use Samarete\Models\Associazione;

use Samarete\Repositories\FileRepository;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    /**
     * The ruolo repository instance.
     */
    protected $files;

    /**
     * Create a new controller instance.
     *
     * @param  FileRepository  $files
     * @return void
     */
    public function __construct(FileRepository $files)
    {
        $this->files = $files;
    }
    
    public function getFiles(Request $request)
    {
        $this->authorize('view', File::class);
        return response()->json($this->files->getAll());
    }
    
    public function getFile(ViewFileRequest $request)
    {
        $file = $this->files->getById($request->id);
        $this->authorize('view', $file);
        return response()->json($file);
    }
    
    public function downloadFile(ViewFileRequest $request)
    {
        $file = $this->files->getById($request->id);
        $this->authorize('download', $file);
        if(empty($file))
            return response()->json(array("status" => 400, "message" => "ERROR"));
        $pathToFile = $this->files->getCompleteFilePath($file);
        return response()->download($pathToFile, $file->nome_originale);
    }
    
    public function deleteTmpFile(DeleteFileRequest $request)
    {
        $file = $this->files->getTmpById($request->id);
        $this->authorize('delete', $file);
        $this->files->deleteTmp($file);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function deleteFile(DeleteFileRequest $request)
    {
        $file = $this->files->getById($request->id);
        $this->authorize('delete', $file);
        $this->files->delete($file);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function saveTmpFile(SaveTmpFileRequest $request)
    {
        $this->authorize('upload', File::class);
        $fileid = 0;
        if($request->hasFile('file')){
            $file = $this->files->saveTmpFile($request->file);
            $fileid = $file->id;
        }
        return response()->json(array("status" => empty($file) ? 400 : 200, "file_id" => $fileid));
    }
    
    public function confirmFile(SaveFileRequest $request)
    {
        $associazione = AssociazioneRepository::getById($request->associazione);
        $file = $this->files->getTmpById($request->file);
        $this->authorize('save', $file);
        $this->files->saveFile($associazione, $request->file);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function saveFile(SaveFileRequest $request)
    {
        $this->authorize('upload', File::class);
        $fileid = 0;
        if($request->hasFile('file')){
            $file = $this->files->saveFile($request->file);
            $fileid = $file->id;
        }
        return response()->json(array("status" => empty($file) ? 400 : 200, "file_id" => $fileid));
    }
    
    public function saveMultipleFile(SaveMultipleFileRequest $request)
    {
        $associazione = AssociazioneRepository::getById($request->associazione);
        foreach(explode(',', $request->files) as $fileid){
            $id = intval($fileid);
            $file = $this->files->getTmpById($id);
            $this->authorize('save', $file);
            $this->files->saveFile($associazione, $request->file);
        }
        return response()->json(array("status" => 200, "message" => "OK"));
    }
}
