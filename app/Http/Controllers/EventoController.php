<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Evento;
use App\Models\Gasto;
use App\Models\Gasto_de_presupuesto;
use App\Models\User;
use App\Models\User_evento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EventoController extends Controller
{
    public function inicio()
    {
        
        return view('inicioVista');
    }

    public function eventoConPresu()
    {
        
        return view('vistasTiposEvento.eventoConPresuVista');
    }

    public function eventoSinPresu()
    {
        
        return view('vistasTiposEvento.eventoSinPresuVista');
    }

    public function eventoFinalizado()
    {
        
        return view('vistasTiposEvento.eventoFinalizadoVista');
    }

    /**FUNCIONALIDADES PARA CREAR Y MODIFICAR EVENTOS
     * FALTA MENSAJES DE SESION **/

    //PARA CREAR Y MODIFICAR EVENTO
    public function newEventoSinPresu(){
        return view('vistasTiposEvento.admin-crear-sin-presuVista');
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
        session(["evento_id" => $request->id]);
        $evento = $eventos[0];
        $isAdmins = User_evento::select('is_admin_principal','is_admin_secundario')->where('evento_id',$evento->id)->where('user_id', session('id'))->get();
        $isAdmin = $isAdmins[0];
        $gastos = DB::select("SELECT gastos.id, gastos.evento_id, gastos.usuario_id, gastos.descripcion, gastos.coste, gastos.foto, gastos.created_at,  gastos.is_aceptado, users.alias as alias FROM gastos 
                                LEFT JOIN users ON gastos.usuario_id = users.id  WHERE gastos.evento_id = ?",[$request->id]);
        $pagos = $this->pagadoEvento($request->id);
        $listaParticipantes = DB::select("SELECT evento_id, user_id, is_admin_principal, is_admin_secundario, users.alias FROM users_eventos 
                                        LEFT JOIN users   ON users.id = users_eventos.user_id WHERE evento_id = ?", [$request->id]);
        return view('vistasTiposEvento.eventoSinPresuVista', compact('evento', 'isAdmin', 'gastos', 'pagos', 'listaParticipantes'));
    }

    /**
     * Formulario para editar por el id del evento
     */
    public function editarEventoSinPresu(Request $request){
        $eventos = Evento::whereId($request->id)->get();
        $evento = $eventos[0];
        $gastos = DB::select("SELECT gastos.id, gastos.evento_id, gastos.usuario_id, gastos.descripcion, gastos.coste, gastos.foto, gastos.created_at, gastos.is_aceptado, users.alias as alias FROM gastos 
                                LEFT JOIN users ON gastos.usuario_id = users.id  WHERE gastos.evento_id = ?",[$request->id]);
        return view('vistasTiposEvento.editarEventoSinPresuVista', compact('evento', 'gastos'));
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
                $request = new Request(['id' => $evento->id]);
                return $this->verEvento($request);
        } catch (Exception $e) {
            session()->flash('error_datos_evento',str_contains($e->getMessage(), 'more error') == true ? 
                            'Los campos Nombre Evento, Descripción y Fecha inicio son obligatorios' : $e->getMessage());
            return $this->editarEventoSinPresu($request);
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
            session()->flash('error_gasto',"El campo gasto debe ser mayor a 1 y descripción es obligatorio");
            
        }finally{
            $request = new Request(['id' => $request->evento_id]);
            return $this->verEvento($request);
        }
        
    }

    /**
     * Validar datos de un gasto
     */
    private function validarGastos(Request $request){        
        return $request->validate([
            'evento_id' => 'required',
            'descripcion' => 'required|max:255',
            'coste' => 'required|numeric|min:1',
            'foto' => '',
        ]);
        
    }

    /**
     * Aceptar Gasto para hacerlo visible para usuarios no Administradores
     */
    public function aceptarGasto(Request $request){
        DB::update("UPDATE gastos set is_aceptado = true WHERE gastos.id = ?", [$request->gasto_id]);
        $request = new Request(['id' => $request->evento_id]);
        return $this->verEvento($request);
    }

    /**
     * Eliminar gasto por ID de gasto
     */
    public function eliminarGasto(Request $request){
        DB::delete("DELETE FROM gastos WHERE evento_id = ? AND id = ?",[$request->evento_id, $request->gasto_id]);
        $request = new Request(['id' => $request->evento_id]);
        return $this->verEvento($request);
    }

    /**
     * Todo lo pagado en evento concreto por el id
     */
    public function pagadoEvento($id){
        $pagos = DB::select("SELECT sum(gastos.coste) pagado, usuario_id, users.alias FROM gastos 
                            RIGHT JOIN users ON users.id = gastos.usuario_id WHERE evento_id = ? AND is_aceptado = true GROUP BY usuario_id", [$id]);
        // $pagos = DB::select("SELECT sum(gastos.coste) pagado, usuario_id, users.alias FROM gastos 
        //                     RIGHT JOIN users ON users.id = gastos.usuario_id WHERE evento_id = ? AND is_aceptado = true GROUP BY usuario_id", [$id]);
        return $pagos;
    }

    //AÑADIR PARTICIPANTES Y ADMINISTRADORES SECUNDARIOS

    /**
     * Ver mis contactos para añadirlos como Pacticipantes en el evento
     * @return array $id_y_alias
     */
    public function verContactosParaEvento(Request $request){
        $misContactos = DB::select("SELECT usuario_agreagador_id AS IDs FROM agregar_aceptar WHERE usuario_agreagado_id = ? AND is_aceptado = true
                                UNION SELECT usuario_agreagado_id FROM agregar_aceptar WHERE usuario_agreagador_id = ? AND is_aceptado = true",
                                [session("id") , session("id")]);
        $IDsContactos=[];
        foreach ($misContactos as $key => $contacto) {
                $IDsContactos[]=$contacto->IDs;
        }
        $Participantes = User_evento::select('user_id')->where('evento_id', session("evento_id"))->get();
        $IDsParti=[];
        foreach ($Participantes as $key => $Participante) {
                $IDsParti[]=$Participante->user_id;
        }
        $contactos = User::select("id","alias")->whereIn('id',array_diff($IDsContactos,$IDsParti))->get();
        return view('vistasTiposEvento.verContactosParaEventoVista', compact('contactos'));
    }

    public function verContactosDeEvento(){
        $contactos = DB::table('users')->join('users_eventos', 'users.id', '=', 'users_eventos.user_id')
                                    ->join('eventos','users_eventos.evento_id', '=', 'eventos.id')
                                    ->where('eventos.id', '=', session('evento_id'))
                                    ->where('users.id', '<>', session('id'))
                                    ->select('users.id','users.alias', 'users_eventos.is_admin_principal', 'users_eventos.is_admin_secundario')->get();
        return view('vistasTiposEvento.verContactosEnEventoVista', compact('contactos'));
        
    }

    /**
     * Añadir contacto a participante de evento
     */
    public function addParticipante(Request $request){
        try {
            $validar = $request->validate([
                "evento_id" => "required|numeric",
                "user_id" => "required|numeric"
            ]);
            $participante = new User_evento();
            $participante->evento_id = session("evento_id");
            $participante->user_id = $request->input("user_id");
            $participante->save();
            session()->flash('status',"Participante añadido");
        } catch (Exception $e) {
            session()->flash('status',"No se ha podido añadir participante");
        }finally{
            $request = new Request(['evento_id' => session('evento_id')]);
            return $this->verContactosParaEvento($request);
        }
        
        
    }

    public function eliminarParticipante(Request $request){
        try {
            $validar = $request->validate([
                "evento_id" => "required|numeric",
                "user_id" => "required|numeric"
            ]);
            $participante = User_evento::where('evento_id', $request->evento_id)
                            ->where('user_id', $request->user_id)->delete();
            
            session()->flash('participante',"Participante eliminado");
        } catch (Exception $e) {
            session()->flash('participante',"No se ha podido eliminar participante");
        }finally{
            $request = new Request(['id' => session('evento_id')]);
            return $this->verContactosDeEvento($request);
        }
    }

    public function makeParticipanteAdminSecun(Request $request){
        try {
            $validar = $request->validate([
                "evento_id" => "required|numeric",
                "user_id" => "required|numeric"
            ]);
            $participante = User_evento::where('evento_id', $request->evento_id)
                            ->where('user_id', $request->user_id)->where('is_admin_secundario', '=', false)
                            ->update(['is_admin_secundario' => true]);
            
            session()->flash('status',"Participante convertido a Admin Secundario");
            return $this->verContactosDeEvento($request);
        } catch (Exception $e) {
            session()->flash('status',"No se ha podido convertir a Admin Secundario");
            $request = new Request(['id' => session('evento_id')]);
            return $this->verEvento($request);
        }
    }

    public function eliminarParticipanteAdminSecun(Request $request){
        try {
            $validar = $request->validate([
                "evento_id" => "required|numeric",
                "user_id" => "required|numeric"
            ]);
            $participante = User_evento::where('evento_id', $request->evento_id)
                            ->where('user_id', $request->user_id)->where('is_admin_secundario', '=', true)
                            ->update(['is_admin_secundario' => false]);
            
            session()->flash('status',"Participante ha dejado de ser Admin Secundario");
            return $this->verContactosDeEvento($request);
        } catch (Exception $e) {
            session()->flash('status',"No se ha podido eliminar Admin Secundario");
            $request = new Request(['id' => session('evento_id')]);
            return $this->verEvento($request);
        }
    }

/*
    public function addGastoPresupuesto(Request $request){

    }

    public function eliminarPresupuestoGasto(Request $request){

    }

v
    public function valorRoute($id){
        return $id;
    }*/
}
