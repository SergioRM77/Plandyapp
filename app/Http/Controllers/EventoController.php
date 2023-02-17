<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\User_evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



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
        return view('tiposEvento.admin-crear-sin-presu');
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
        $newEvento = new Evento();
        $newEvento->tipo_evento_id = 1;
        $newEvento->nombre_evento = $request->nombre_evento;
        $newEvento->descripcion = $request->descripcion;
        $newEvento->fecha_inicio = $request->fecha_inicio;
        $newEvento->fecha_fin = $request->fecha_fin;
        $newEvento->tags = $request->tags;
        $newEvento->foto = $request->foto;
        $newEvento->save();


        $Admin_principal_user_evento = new User_evento();
        $Admin_principal_user_evento->evento_id = $newEvento->id;
        $Admin_principal_user_evento->user_id = session('id');
        $Admin_principal_user_evento->is_admin_principal = true;
        $Admin_principal_user_evento->save();


        return $request;
    }

    

    public function verEvento(Request $request){
        $eventos = Evento::whereId($request->id)->get();
        $evento = $eventos[0];
        $isAdmins = User_evento::where('evento_id',$evento->id)->where('user_id', session('id'))->get('is_admin_principal');
        $isAdmin = $isAdmins[0];
        return view('tiposEvento.eventoSinPresu', compact('evento', 'isAdmin'));

    }

    /**
     * Formulario para editar por el id del vento
     */
    public function editarEventoSinPresu(Request $request){
        $eventos = Evento::whereId($request->id)->get();
        $evento = $eventos[0];
        return view('tiposEvento.editarEventoSinPresu', compact('evento'));
    }

    public function updateEventoSinPresu(Request $request){

    }





    /*
    public function addGasto(Request $request){
        $request->validate([
            'evento_id' => 'required',
            'usuario_id' => 'required',
            'descripcion' => '',
            'coste' => 'required',
            'fecha_hora' => '',
            'foto' => '',
        ]);
        
    }

    public function addGastoPresupuesto(Request $request){

    }

    public function eliminarPresupuestoGasto(Request $request){

    }

    public function eliminarGasto(Request $request){

    }

    public function aceptarGasto(Request $request){

    }

    public function addParticipante(Request $request){

    }

    public function eliminarParticipante(Request $request){

    }

    public function makeParticipanteAdminSecun(Request $request){

    }

    public function eliminarParticipanteAdminSecun(Request $request){

    }

    public function valorRoute($id){
        return $id;
    }*/
}
