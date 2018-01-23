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
        $user = UserRepository::getById($file->proprietario_id);
        return 'utenti/'.$user->datapath;
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
    
    public static function confirmFileById(User $user, $tmpfileid)
    {
        $file = self::getTmpById($tmpfileid);
        if(empty($file)) return null;
        return self::confirmFile($user, $file);
    }
    
    public static function confirmFile(User $user, FileTmp $tmpfile)
    {
        if(empty($tmpfile)) return null;
        $newfile = new File;
        $newfile->nome = $tmpfile->nome;
        $newfile->nome_originale = $tmpfile->nome_originale;
        $newfile->dimensione = $tmpfile->dimensione;
        $newfile->data_caricamento = $tmpfile->data_caricamento;
        $newfile->proprietario_id = $user->id;
        Storage::move('tmp/'.$newfile->nome, 'utenti/'.$user->datapath.'/'.$newfile->nome);
        $newfile->save();
        $tmpfile->delete();
        return $newfile;
    }
    
    public static function saveFile(User $user, $file)
    {
        $newfile = new File;
        $newdir = Storage::putFile('utenti/'.$user->datapath, $file);
        $newfile->nome = end(explode('/', $newdir));
        $newfile->nome_originale = $file->getClientOriginalName();
        $newfile->dimensione = intval($file->getClientSize());
        $newfile->data_caricamento = new \DateTime();
        $newfile->proprietario_id = $user->id;
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