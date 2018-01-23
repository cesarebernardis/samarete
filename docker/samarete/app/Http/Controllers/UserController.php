<?php

namespace Samarete\Http\Controllers;

use Samarete\Http\Requests\ViewUserRequest;
use Samarete\Http\Requests\SaveUserRequest;
use Samarete\Http\Requests\DeleteUserRequest;
use Samarete\Http\Requests\ManageRuoloRequest;

use Samarete\Repositories\UserRepository;
use Samarete\Repositories\RuoloRepository;

use Samarete\Models\User;
use Samarete\Models\Ruolo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
    
    public function getUsers(Request $request)
    {
        $this->authorize('view', User::class);
        return response()->json($this->users->getAll());
    }
    
    public function getFreeUsers(Request $request)
    {
        $this->authorize('view', User::class);
        return response()->json($this->users->getFree());
    }
    
    public function getUser(ViewUserRequest $request)
    {
        $user = $this->users->getById($request->id);
        $this->authorize('view', $user);
        return response()->json($user);
    }
    
    public function getRuoliUsers(Request $request)
    {
        $this->authorize('edit', User::class);
        return response()->json($this->users->getRuoliUsers());
    }
    
    public function checkUsername(Request $request)
    {
        $this->authorize('create', User::class);
        $username = $request->username;
        $id = $request->id;
        $result = $this->users->checkUsername($username, $id);
        return $result ? 'true' : 'false';
    }
    
    public function addRuolo(ManageRuoloRequest $request)
    {
        $ruolo = RuoloRepository::getById($request->ruolo_id);
        $user = $this->users->getById($request->user_id);
        $this->authorize('addRuolo', $user);
        if(empty($ruolo) || empty($user)){
            return response()->json(array("status" => 400, "message" => "ERROR"));
        }
        $this->users->addRuolo($user, $ruolo);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function revokeRuolo(ManageRuoloRequest $request)
    {
        $ruolo = RuoloRepository::getById($request->ruolo_id);
        $user = $this->users->getById($request->user_id);
        $this->authorize('revokeRuolo', $user);
        if(empty($ruolo) || empty($user)){
            return response()->json(array("status" => 400, "message" => "ERROR"));
        }
        $this->users->revokeRuolo($user, $ruolo);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function deleteUser(DeleteUserRequest $request)
    {
        $user = UserRepository::getById($request->id);
        $this->authorize('delete', $user);
        $this->users->delete($user);
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function toggleUser(DeleteUserRequest $request)
    {
        $user = $this->users->getById($request->id);
        $this->authorize('edit', $user);
        $user->updated_at = new \DateTime();
        $user->attivo = !$user->attivo;
        $user->save();
        return response()->json(array("status" => 200, "message" => "OK"));
    }
    
    public function saveUser(SaveUserRequest $request)
    {
        $user = new User;
        if(!empty($request->id)){
            $user = UserRepository::getById($request->id);
            if(empty($user))
                return response()->json(array("status" => 400, "message" => "ID Utente non valido"));
            $this->authorize('edit', $user);
        }else{
            if(empty($request->password))
                return response()->json(array("status" => 400, "message" => "Password vuota"));
            $this->authorize('create', User::class);
            $user->created_at = new \DateTime();
            $user->datapath = hash('sha256', time().'$_$'.$request->username);
            Storage::makeDirectory('utenti/'.$user->datapath, 0775, true);
        }
        
        if($request->password != $request->conferma_password){
            return response()->json(array("status" => 400, "message" => "Le password non coincidono"));
        }
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->nome = $request->nome;
        $user->cognome = $request->cognome;
        $user->email = $request->email;
        $user->updated_at = new \DateTime();
        $user->save();
        return response()->json(array("status" => 200, "message" => "OK"));
    }
}
