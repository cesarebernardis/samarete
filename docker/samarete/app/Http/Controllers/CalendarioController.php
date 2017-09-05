<?php

namespace Samarete\Http\Controllers;

use Illuminate\Http\Request;

use Samarete\Repositories\UserRepository;
use Samarete\Repositories\AssociazioneRepository;
use Samarete\Repositories\EventoRepository;
use Samarete\Repositories\ProgettoRepository;
use Samarete\Repositories\ServizioRepository;


class CalendarioController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @param  CalendarioRepository  $calendari
     * @return void
     */
    public function __construct()
    {
        
    }
    
    public function index(Request $request)
    {
        $eventi = EventoRepository::getAll();
        $servizi = ServizioRepository::getAll();
        return view('calendario.index', ['eventi' => $eventi, 'servizi' => $servizi]);
    }
    
}
