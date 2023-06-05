<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Evento;
use App\Models\Gasto;
use App\Models\Gasto_de_presupuesto;
use App\Models\User;
use App\Models\User_evento;
use App\Models\Usuario_participa_actividad;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Http\Controllers\EventoController;

class ActividadesController extends Controller
{
    /**
     * Añadir una actividad a Evento
     */
    public function addActividad(Request $request){
        try {
            $validar = $request->validate([
                'nombre_actividad' => 'required|max:100',
                'coste' => 'required|numeric|min:1|max:999999',
                'descripcion_actividad' => 'nullable|max:255',
                'fecha' => 'nullable|date',
                'hora' => 'nullable|date_format:H:i'
            ]);

            $actividad = new Actividad();
            $actividad->evento_id = session('evento_id');
            $actividad->nombre_actividad = $request->input('nombre_actividad');
            $actividad->coste = $request->input('coste');
            $actividad->descripcion_actividad = $request->input('descripcion_actividad');
            $actividad->fecha = $request->input('fecha');
            $actividad->hora = $request->input('hora');
            $actividad->save();
            session()->flash('status', 'Se ha añadido una nueva actividad');
        } catch (Exception $e) {
            session()->flash('status', $e->getMessage());
            
        }finally{
            return (new EventoController)->verEventoGet($actividad->evento_id);
        }
    }
    /**
     * Editar una nueva actividad
     */
    public function editarActividad(Request $request){
        try {
            $request->validate([
                'id_actividad' => 'required|numeric'
            ]);
            
            $actividad = Actividad::where('id', $request->id_actividad)->where('evento_id', session('evento_id'))->first();
            return view('vistasTiposEvento.editarActividadVista', compact('actividad'));

        } catch (\Throwable $th) {
            session()->flash('status', 'No se puede editar actividad');
            return (new EventoController)->verEventoGet(session('evento_id'));
        }
    }
    /**
     * Actualizar una actividad ya creada
     */
    public function actualizarActividad(Request $request){
    
        try {
            $request->validate([
                'id_actividad' => 'required|numeric',
                'nombre_actividad' => 'required|max:100',
                'coste' => 'required|numeric|min:1|max:99999',
                'descripcion_actividad' => 'nullable|max:255',
                'fecha' => 'nullable',
                'hora' => 'nullable'
            ]);

            $actividad = Actividad::where('id',$request->id_actividad)->where('evento_id', session('evento_id'))->first();
            $actividad->nombre_actividad = $request->input('nombre_actividad');
            $actividad->coste = $request->input('coste');
            $actividad->descripcion_actividad = $request->input('descripcion_actividad');
            $actividad->fecha = $request->input('fecha');
            $actividad->hora = $request->input('hora');
            $actividad->save();
            session()->flash('status', 'Se ha actualizado una actividad');
        } catch (Exception $e) {
            session()->flash('status', 'No se ha podido actualizar actividad');
            
        }finally{
            return (new EventoController)->verEventoGet(session('evento_id'));
        }
    }
    /**
     * Eliminar Actividad existente en evento
     */
    public function eliminarActividad(Request $request){
        try {
            Usuario_participa_actividad::where('actividad_id', $request->id_actividad)->delete();
            Actividad::where('id', $request->id_actividad)
                        ->where('nombre_actividad', $request->nombre_actividad)->delete();
                        session()->flash('status', 'Se ha eliminado actividad');
        } catch (Exception $th) {
            session()->flash('status', 'No se ha podido eliminar actividad');
        }finally{
            return (new EventoController)->verEventoGet(session('evento_id'));
        }
        
        
    }
    /**
     * Retorna todas las Actividades de evento actual
     */
    public static function listaActividades(){
        return Actividad::where('evento_id', '=', session('evento_id'))->orderBy('created_at', 'desc')->get();
    }
    /**
     * Unirse a actividad
     */
    public function unirseActividad(Request $request){
        try {
            $request->validate([
                'actividad_id' => 'required|numeric'
            ]);
            $participante = new Usuario_participa_actividad();
            $participante->actividad_id = $request->input('actividad_id');
            $participante->participante_id = session('id');
            $participante->save();
            session()->flash('status', 'Añadido a Actividad');
        } catch (Exception $th) {
            session()->flash('status', 'No se ha podido añadir a Actividad');
        }finally{
            return (new EventoController)->verEventoGet(session('evento_id'));
        }
    }
    /**
     * Salir de una actividad en la que participo
     */
    public function salirDeActividad(Request $request){
        try {
            $request->validate([
                'actividad_id' => 'required|numeric'
            ]);
            Usuario_participa_actividad::where('actividad_id', '=', $request->actividad_id)
                                        ->where('participante_id', '=', session('id'))->delete();
            session()->flash('status', 'Has salido de una Actividad');
        } catch (Exception $e) {
            session()->flash('status', 'No ha sido posible salir de una Actividad');
        }finally{
            return (new EventoController)->verEventoGet(session('evento_id'));
        }
    }
    /**
     * Retorna los datos de los participantes de una actividad
     */
    public static function participantesEnActividades(){
        return DB::table('usuario_participa_actividad')
                    ->join('actividades', 'usuario_participa_actividad.actividad_id', '=', 'actividades.id')
                    ->join('users', 'users.id', '=', 'usuario_participa_actividad.participante_id')
                    ->select('usuario_participa_actividad.actividad_id', 'usuario_participa_actividad.participante_id', 'users.alias')
                    ->where('actividades.evento_id', '=', session('evento_id'))->get();
    }
}
