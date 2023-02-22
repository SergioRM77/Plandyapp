<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Evento;
use App\Models\Gasto;
use App\Models\Gasto_de_presupuesto;
use App\Models\User_evento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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

    /**FUNCIONALIDADES PARA CREAR Y MODIFICAR EVENTOS
     * FALTA MENSAJES DE SESION **/

    //PARA CREAR Y MODIFICAR EVENTO
    public function newEventoSinPresu(){
        return view('tiposEvento.admin-crear-sin-presu');
    }
    public function newEventoConPresu(){

    }

    /**
     * Crear un nuevo evento
     */
    public function saveEventoSinPresu(Request $request){
        
        if($this->validarDatosEvento($request)){
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
            return redirect('inicio');
        }
        
        return "error no se ha creado evento";
    }

    /**
     * Valida datos básicos de evento
     */
    private function validarDatosEvento(Request $request){
        return $request->validate([
            'nombre_evento' => 'required|max:250',
            'descripcion' => 'required|max:250',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'nullable|after_or_equal:fecha_inicio',
            'tags' => 'max:250',
            'foto' => '',
        ]);
    }


    /**
     * Muestra un evento en concreto, solo texto plano
     */
    public function verEvento(Request $request){
        $eventos = Evento::whereId($request->id)->get();
        $evento = $eventos[0];
        $isAdmins = User_evento::where('evento_id',$evento->id)->where('user_id', session('id'))->get('is_admin_principal');
        $isAdmin = $isAdmins[0];
        $gastos = DB::select("SELECT gastos.id, gastos.evento_id, gastos.usuario_id, gastos.descripcion, gastos.coste, gastos.foto, gastos.created_at,  gastos.is_aceptado, users.alias as alias FROM gastos 
                                LEFT JOIN users ON gastos.usuario_id = users.id  WHERE gastos.evento_id = ?",[$request->id]);
        return view('tiposEvento.eventoSinPresu', compact('evento', 'isAdmin', 'gastos'));
    }

    /**
     * Muestra evento solo por el ID
     */
    private function eventoPorID($id){
        $eventos = Evento::whereId($id)->get();
        $evento = $eventos[0];
        $isAdmins = User_evento::where('evento_id',$evento->id)->where('user_id', session('id'))->get('is_admin_principal');
        $isAdmin = $isAdmins[0];
        //$gastos = Gasto::whereEvento_id($id)->get();
        $gastos = DB::select("SELECT gastos.id, gastos.evento_id, gastos.usuario_id, gastos.descripcion, gastos.coste, gastos.foto, gastos.created_at, gastos.is_aceptado, users.alias as alias FROM gastos 
                                LEFT JOIN users ON gastos.usuario_id = users.id  WHERE gastos.evento_id = ?",[$id]);
        return view('tiposEvento.eventoSinPresu', compact('evento', 'isAdmin', 'gastos'));

    }

    /**
     * Formulario para editar por el id del evento
     */
    public function editarEventoSinPresu(Request $request){
        $eventos = Evento::whereId($request->id)->get();
        $evento = $eventos[0];
        $gastos = DB::select("SELECT gastos.id, gastos.evento_id, gastos.usuario_id, gastos.descripcion, gastos.coste, gastos.foto, gastos.created_at, gastos.is_aceptado, users.alias as alias FROM gastos 
                                LEFT JOIN users ON gastos.usuario_id = users.id  WHERE gastos.evento_id = ?",[$request->id]);
        return view('tiposEvento.editarEventoSinPresu', compact('evento', 'gastos'));
    }

    /**
     * Editar evento ya creado y guardar cambios
     */
    public function updateEventoSinPresu(Request $request){
        try {
                $this->validarDatosEvento($request);
                $evento = Evento::whereId($request->id)->get()->first();
                $evento->nombre_evento = $request->nombre_evento;
                $evento->descripcion = $request->descripcion;
                $evento->fecha_inicio = $request->fecha_inicio;
                $evento->fecha_fin = $request->fecha_fin;
                $evento->tags = $request->tags;
                $evento->foto = $request->foto;
                $evento->save();
        } catch (Exception $e) {
            session()->flash('status', $e->getMessage());
        }finally{
            return $this->eventoPorID($request->id);
        }
    }


    //PRESENTAR ACEPTAR Y ELIMINAR GASTOS

    /**
     * Presentar un nuevo gasto
     */
    public function addGasto(Request $request){
        try {
            $this->validarGastos($request);
            $nuevoGasto = new Gasto();
            $nuevoGasto->evento_id = $request->evento_id;
            $nuevoGasto->usuario_id = session('id');
            $nuevoGasto->coste = $request->coste;
            $nuevoGasto->descripcion = $request->descripcion;
            $nuevoGasto->save();
        } catch (Exception $e) {
            session()->flash('status',$e->getMessage());
            
        }finally{
            return $this->eventoPorID($request->evento_id);
        }
        
    }


    private function validarGastos(Request $request){
        return $request->validate([
            'evento_id' => 'required',
            'descripcion' => 'required',
            'coste' => 'required|numeric|min:1',
            'foto' => '',
        ]);
        
    }

    /**
     * Aceptar Gasto para hacerlo visible para usuarios no Administradores
     */
    public function aceptarGasto(Request $request){
        DB::update("UPDATE gastos set is_aceptado = true WHERE gastos.id = ?", [$request->gasto_id]);
        return $this->eventoPorID($request->evento_id);
    }

    /**
     * Eliminar gasto por ID de gasto
     */
    public function eliminarGasto(Request $request){
        DB::delete("DELETE FROM gastos WHERE evento_id = ? AND id = ?",[$request->evento_id, $request->gasto_id]);
        return $this->eventoPorID($request->evento_id);
    }

    /**
     * Todo lo pagado en evento concreto
     */
    public function pagadoEvento($request){
        $pagado = DB::select("SELECT sum(gastos.coste) pagado, usuario_id, users.alias FROM gastos 
                            RIGHT JOIN users ON users.id = gastos.usuario_id WHERE evento_id = ? GROUP BY usuario_id", [$request]);
        return $pagado;
    }

/*
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
