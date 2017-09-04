<?php

namespace Samarete\Repositories;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Samarete\Models\User;
use Samarete\Models\File;
use Samarete\Models\FileTmp;
use Samarete\Models\Permesso;
use Samarete\Models\Associazione;

class FileRepository
{
    public static function getAll()
    {
        return File::all();
    }
    
    public static function getByNome($name)
    {
        return File::where('nome', $name)->first();
    }
    
    public static function getTmpByNome($name)
    {
        return FileTmp::where('nome', $name)->first();
    }
    
    public static function getById($id)
    {
        return File::where('id', $id)->first();
    }
    
    public static function getTmpById($id)
    {
        return FileTmp::where('id', $id)->first();
    }
    
    public static function getCompleteFilePath(File $file)
    {
        return self::getFilePath($file).'/'.$file->nome;
    }
    
    public static function getFilePath(File $file)
    {
        $associazione = AssociazioneRepository::getById($file->proprietario_id);
        return 'associazioni/'.$associazione->datapath;
    }
    
    public static function saveTmpFile($file)
    {
        $newfile = new FileTmp;
        $newdir = Storage::putFile('tmp', $file);
        $newdir = explode('/', $newdir);
        $newfile->nome = end($newdir);
        $newfile->nome_originale = $file->getClientOriginalName();
        $newfile->dimensione = intval($file->getClientSize());
        $newfile->data_caricamento = new \DateTime();
        $newfile->uploader_id = Auth::user()->id;
        $newfile->save();
        return $newfile;
    }
    
    public static function confirmFile(Associazione $associazione, FileTmp $tmpfile)
    {
        $newfile = new File;
        $newfile->nome = $tmpfile->nome;
        $newfile->nome_originale = $tmpfile->nome_originale;
        $newfile->dimensione = $tmpfile->dimensione;
        $newfile->data_caricamento = $tmpfile->data_caricamento;
        $newfile->proprietario_id = $associazione['id'];
        Storage::move('tmp/'.$newfile->nome, 'associazioni/'.$associazione->datapath.'/'.$newfile->nome);
        $newfile->save();
        $tmpfile->delete();
        return $newfile;
    }
    
    public static function saveFile(Associazione $associazione, $file)
    {
        $newfile = new File;
        $newdir = Storage::putFile('associazioni/'.$associazione->datapath, $file);
        $newfile->nome = end(explode('/', $newdir));
        $newfile->nome_originale = $file->getClientOriginalName();
        $newfile->dimensione = intval($file->getClientSize());
        $newfile->data_caricamento = new \DateTime();
        $newfile->proprietario_id = $associazione['id'];
        $newfile->save();
        return $newfile;
    }
    
    public static function deleteTmpById($id)
    {
        $file = self::getTmpById($id);
        if(empty($file)){
            return false;
        }
        return self::deleteTmp($file);
    }
    
    public static function deleteTmp(FileTmp $file)
    {
        DB::delete('DELETE FROM file_tmp WHERE id = ?', [$file['id']]);
        Storage::delete('tmp/'.$file['nome']);
        return true;
    }
    
    public static function deleteById($id)
    {
        $file = self::getById($id);
        if(empty($file)){
            return false;
        }
        return self::delete($file);
    }
    
    public static function delete(File $file)
    {
        $path = self::getCompleteFilePath($file);
        DB::delete('DELETE FROM file WHERE id = ?', [$file['id']]);
        Storage::delete($path);
        return true;
    }
    
    public static function getBase64Uri(File $file)
    {
        $content = Storage::get($file->getCompleteFilepath());
        return 'data:image/*;base64,'.base64_encode($content);
    }
    
    public static function clearTmpFileTable()
    {
        foreach(FileTmp::where('data_caricamento', '<', Carbon::yesterday())->get() as $file){
            self::deleteTmp($file);
        }
    }
    
}