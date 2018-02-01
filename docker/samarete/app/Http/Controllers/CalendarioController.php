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
        return view('calendario.index', []);
    }
    
    public function getEventi(Request $request)
    {
        $eventi = EventoRepository::getAll();
        $giorni = array();
        foreach($eventi as $evento){
            foreach($evento->giorni as $giorno){
                $obj = new \stdClass();
                $obj->title = $evento->nome." - ".$giorno->descrizione;
                $obj->start = $giorno->giorno.'T'.$giorno->da;
                $obj->end = $giorno->giorno.'T'.$giorno->a;
                $obj->url = '/eventi/view-evento?id='.$evento->id;
                $giorni[] = $obj;
            }
        }
        return response()->json($giorni);
    }
    
    public function getServizi(Request $request)
    {
        $servizi = ServizioRepository::getAll();
        $giorni = array();
        foreach($servizi as $servizio){
            foreach($servizio->getGiorni($request->start, $request->end) as $giorno){
                $obj = new \stdClass();
                $obj->title = $servizio->nome." - ".$giorno->descrizione;
                $obj->start = $giorno->giorno.'T'.$giorno->da;
                $obj->end = $giorno->giorno.'T'.$giorno->a;
                $obj->url = '/servizi/view-servizio?id='.$servizio->id;
                $giorni[] = $obj;
            }
        }
        return response()->json($giorni);
    }
    
}
