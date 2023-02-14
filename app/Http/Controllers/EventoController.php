<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function inicio()
    {
        
        return view('inicio');
    }

    public function eventoConPresu()
    {
        
        return view('tiposEvento.eventoConPresu');
    }

    public function eventoSinPresu()
    {
        
        return view('tiposEvento.eventoSinPresu');
    }

    public function eventoFinalizado()
    {
        
        return view('tiposEvento.eventoFinalizado');
    }

    /** */
    
    public function crearTipoEvento(Request $request){

    }
}
