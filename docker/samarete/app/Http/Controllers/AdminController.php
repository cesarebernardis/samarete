<?php

namespace Samarete\Http\Controllers;

use Illuminate\Http\Request;

use Samarete\Models\User;
use Samarete\Models\Ruolo;
use Samarete\Models\Permesso;
use Samarete\Models\Associazione;

use Samarete\Repositories\UserRepository;

class AdminController extends Controller
{
    //
    
    /**
     * Create a new AdminController instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('admin');
    }*/
    
    public function index()
    {
        $counters = [
            'users' => User::where('attivo', 1)->count(),
            'ruolo' => Ruolo::where('attivo', 1)->count(),
            'permesso' => Permesso::count(),
            'associazione' => Associazione::where('attivo', 1)->count(),
        ];
        return response()->view('admin.index', ['counters' => $counters]);
    }
    
    public function users()
    {
        return response()->view('admin.users', ['users' => User::all(), 'ruoli' => Ruolo::all()]);
    }
    
    public function ruoli()
    {
        return response()->view('admin.ruoli', ['permessi' => Permesso::all(), 'ruoli' => Ruolo::all()]);
    }
    
    public function permessi()
    {
        return response()->view('admin.permessi');
    }
    
    public function associazioni()
    {
        return response()->view('admin.associazioni', ['users' => UserRepository::getFree()]);
    }
    
}
