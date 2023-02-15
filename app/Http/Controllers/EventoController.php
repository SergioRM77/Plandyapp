<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\User_evento;
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
        if ($request == "sinPresupuesto") {
            return $this->newEventoSinPresu();
        } else if($request == "conPresupuesto"){
            return $this->newEventoConPresu();
        }
        
    }

    public function newEventoSinPresu(){
        return view('tiposEvento.admin-sin-presu');
    }
    public function newEventoConPresu(){

    }

    public function saveEventoSinPresu(Request $request){
        
        $request->validate([
            'nombre_evento' => 'required|max:250',
            'descripcion' => 'required|max:250',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'nullable|after_or_equal:fecha_inicio',
            'tags' => 'max:250',
            'foto' => '',
        ]);
        return $request;
    }
}
