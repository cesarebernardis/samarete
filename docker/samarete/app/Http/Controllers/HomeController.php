<?php

namespace Samarete\Http\Controllers;

use Samarete\Repositories\AssociazioneRepository;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $associazioni = AssociazioneRepository::getActive();
        return view('home', array('associazioni' => $associazioni));
    }
}
