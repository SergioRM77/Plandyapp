<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Evento;
use App\Models\Gasto;
use App\Models\Gasto_de_presupuesto;
use App\Models\User;
use App\Models\User_evento;
use App\Models\Usuario_participa_actividad;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\ImagenesController;

use function PHPUnit\Framework\returnSelf;

class EventoController extends Controller
{
    
    /**FUNCIONALIDADES PARA CREAR Y MODIFICAR EVENTOS
     * FALTA MENSAJES DE SESION **/

    //PARA CREAR Y MODIFICAR EVENTO

    public function selectTipoEvento(){
        return view('vistasTiposEvento.select-tipo-evento-Vista');
    }

    public function newEvento($tipo){
        return view('vistasTiposEvento.admin-crear-Vista', compact('tipo'));
    }

    /**
     * Crear un nuevo evento
     */
    public function saveEvento(Request $request){
        
        if($this->validarDatosEvento($request)){
            $newEvento = new Evento();
            $newEvento->tipo_evento_id = $request->tipo_evento;
            $newEvento->nombre_evento = $request->nombre_evento;
            $newEvento->descripcion = $request->descripcion;
            $newEvento->fecha_inicio = $request->fecha_inicio;
            $newEvento->fecha_fin = $request->fecha_fin;
            $newEvento->tags = $request->tags;
            $newEvento->foto = ImagenesController::guardarImagen($request);
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
            'tipo_evento' => 'required|numeric|min:1|max:2',
            'descripcion' => 'required|max:250',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'nullable|after_or_equal:fecha_inicio',
            'tags' => 'max:250',
            'foto' => 'nullable|image|max:2048',
        ]);
    }


    /**
     * Muestra un evento en concreto, solo texto plano
     */
    public function verEvento(Request $request){
        $evento = Evento::whereId($request->id)->first();
        
        // tabla users_eventos.is_visible
        $isAdmin = User_evento::select('is_admin_principal','is_admin_secundario', 'is_visible')->where('evento_id',$evento->id)->where('user_id', session('id'))->first();
        session(["evento_id" => $request->id,'tipo_evento' => $evento->tipo_evento_id, 
        'is_activo' => $evento->is_activo, 'is_visible' => $isAdmin->is_visible]);
        $gastos = (new GastosController)->getListaGastos($request->id);
        $gastospresu = (new GastosController)->getListaGastosPresu($request->id);
        $listapagos = (new GastosController)->pagadoEvento($request->id);
        $deben = (new GastosController)->usuarioDebeUsuario($request->id);
        $listaParticipantes = DB::select("SELECT evento_id, user_id, is_admin_principal, is_admin_secundario, users.alias FROM users_eventos 
                                        LEFT JOIN users   ON users.id = users_eventos.user_id WHERE evento_id = ?", [$request->id]);
        $actividades = (new ActividadesController)->listaActividades();
        $listaParticipantesActividades = (new ActividadesController)->participantesEnActividades();
        
        return view('vistasTiposEvento.eventoVista', compact('evento', 'isAdmin', 'gastos', 'listapagos', 'deben', 'listaParticipantes',
                    'actividades', 'listaParticipantesActividades','gastospresu'));
    }

    public function verEventoGet($evento_id){
        if ($evento_id == session('evento_id')) {
            $evento = new Request(['id' => session('evento_id')]);
            return $this->verEvento($evento);
        }
            session()->flash('status','Ha ocurrido un error');
            return redirect('inicio');
    }

    /**
     * Retorna por get vista de evento, al actualizar no se genera envío de formulario
     */
    public function verEventoGet2($id, $nombre){
        $idConsulta = DB::select("SELECT users_eventos.evento_id FROM users_eventos
                                LEFT JOIN eventos ON users_eventos.evento_id = eventos.id 
                                WHERE users_eventos.evento_id = ? AND eventos.nombre_evento = ?
                                AND users_eventos.user_id = ?", [$id, $nombre, session('id')]);
        if($idConsulta[0]->evento_id == $id){
            $evento = new Request(['id' => $id]);
            return $this->verEvento($evento);
        }
            session()->flash('status','Ha ocurrido un error');
            return redirect('inicio');
    }

    /**
     * Formulario para editar por el id del evento
     */
    public function editarEvento(Request $request){
        $evento = Evento::whereId($request->id)->first();
        $gastos = DB::select("SELECT gastos.id, gastos.evento_id, gastos.usuario_id, gastos.descripcion, gastos.coste, gastos.foto, gastos.created_at, gastos.is_aceptado, users.alias as alias FROM gastos 
                                LEFT JOIN users ON gastos.usuario_id = users.id  WHERE gastos.evento_id = ?",[$request->id]);
        return view('vistasTiposEvento.editarEventoVista', compact('evento'));
    }

    /**
     * Editar evento ya creado y guardar cambios
     */
    public function updateEvento(Request $request){
        try {
                $this->validarDatosEvento($request);
                $evento = Evento::whereId($request->id)->get()->first();
                $evento->nombre_evento = $request->nombre_evento;
                $evento->descripcion = $request->descripcion;
                $evento->fecha_inicio = $request->fecha_inicio;
                $evento->fecha_fin = $request->fecha_fin;
                $evento->tags = $request->tags;
                $evento->foto = $request->foto == null ? $evento->foto : ImagenesController::guardarImagen($request);
                $evento->save();
                return $this->verEventoGet($evento->id);
        } catch (Exception $e) {
            session()->flash('error_datos_evento',str_contains($e->getMessage(), 'more error') == true ? 
                            'Los campos Nombre Evento, Descripción y Fecha inicio son obligatorios' : $e->getMessage());
            return $this->editarEvento($request);
        }
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

    /**
     * Eliminar participante de un Evento
     */
    public function eliminarParticipante(Request $request){
        try {
            $request->validate([
                "evento_id" => "required|numeric",
                "user_id" => "required|numeric"
            ]);
            User_evento::where('evento_id', $request->evento_id)
                            ->where('user_id', $request->user_id)->delete();
            
            session()->flash('participante',"Participante eliminado");
        } catch (Exception $e) {
            session()->flash('participante',"No se ha podido eliminar participante");
        }finally{
            $request = new Request(['id' => session('evento_id')]);
            return $this->verContactosDeEvento($request);
        }
    }

    /**
     * Hacer usuario un administrador secundario
     */
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
            return $this->verEventoGet(session('evento_id'));
        }
    }

    public function eliminarParticipanteAdminSecun(Request $request){
        try {
            $request->validate([
                "evento_id" => "required|numeric",
                "user_id" => "required|numeric"
            ]);
            User_evento::where('evento_id', $request->evento_id)
                            ->where('user_id', $request->user_id)->where('is_admin_secundario', '=', true)
                            ->update(['is_admin_secundario' => false]);
            
            session()->flash('status',"Participante ha dejado de ser Admin Secundario");
            return $this->verContactosDeEvento($request);
        } catch (Exception $e) {
            session()->flash('status',"No se ha podido eliminar Admin Secundario");
            return $this->verEventoGet(session('evento_id'));
        }
    }

    public function finalizarEvento(){
        try {
            DB::table("eventos")->where("id","=", session("evento_id"))->where("is_activo","=", true)
                        ->update(["is_activo" => false]);
            
            session()->flash('status',"Has finalizado un evento");
        } catch (Exception $th) {
            session()->flash('status',"No se ha podido finalizar evento");
        }finally{
            return redirect('inicio');
        }
        
    }

    public function eliminarEvento(){
        try {
            DB::table("users_eventos")->where("user_id","=", session("id"))->where("evento_id", "=", session("evento_id"))->update(["is_visible" => false]);
            
            session()->flash('status',"Se ha eliminado evento para ti");
        } catch (Exception $th) {
            session()->flash('status',$th->getMessage());
        }finally{
            return redirect('inicio');
        }
    }
}
