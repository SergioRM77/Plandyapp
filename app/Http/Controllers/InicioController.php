<?php

namespace App\Http\Controllers;

use App\Models\User_evento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function inicio()
    {
        $cadenaEventos =  $this->getEventosActivos();
        // $this->getDatosEventosActivos($cadenaEventos);

        $datosEventos = $this->getDatosEventos();
        $numEventosFinalizados = $this->getNumEventosFinalizados();
        $participantes = $this->getParticipantesEventos();
        $admins = $this->getAdminsEventos();
        $actividades = $this->getActividadesEventos();
        $pagado = $this->getPagadoEventos();
        $eventos=[];
        // return [ $datosEventos, $admins];
        for ($i=0; $i < count($datosEventos); $i++) { 
            $eventos[$i] = array_merge((array)$datosEventos[$i],(array)$participantes[$i],
                        (array)$admins[$i],
                        (array)$actividades[$i], 
                        (array)$pagado[$i]);
        }
        
        return view('inicioVista',compact('eventos', 'numEventosFinalizados'));
    }
    
    //Probar métodos a ver si es mas rapido asi y más corto
    private function getEventosActivos(){
        $eventos = DB::select("SELECT users_eventos.evento_id FROM users_eventos
                            WHERE users_eventos.user_id = ? AND users_eventos.is_visible = true 
                            ORDER BY users_eventos.evento_id", [session('id')]);
        $arrayIDs = [];
        for ($i=0; $i < count($eventos); $i++) { 
            $arrayIDs[$i] = $eventos[$i]->evento_id;
        } 
        return $arrayIDs;
    }

    private function getDatosEventosActivos($arrayIDs){
        return DB::table('eventos')->whereIn('id', $arrayIDs)->get();
    }
    //^^^

    public function getDatosEventos(){
        return DB::select("SELECT eventos.id, eventos.nombre_evento, eventos.fecha_inicio, eventos.fecha_fin, eventos.is_activo, users.id as IDuser, eventos.foto FROM eventos 
                        LEFT JOIN users_eventos ON users_eventos.evento_id = eventos.id
                        LEFT JOIN users ON users_eventos.user_id = users.id
                        WHERE users.id = ? AND users_eventos.is_visible = true ORDER BY eventos.id", [session('id')]);
    }

    public function getNumEventosFinalizados(){
        return DB::select("SELECT count(id) as numFinalizados FROM eventos
                        WHERE is_activo = false");
    }

    public function getParticipantesEventos(){
        return DB::select("SELECT count(user_id) as numParticipantes, evento_id FROM users_eventos
                        RIGHT JOIN eventos ON eventos.id = users_eventos.evento_id
                        WHERE evento_id IN 
                            (SELECT evento_id FROM users_eventos WHERE user_id = ?) AND users_eventos.is_visible = true
                        GROUP BY evento_id ORDER BY eventos.id",[session('id')]);
    }

    public function getAdminsEventos(){
        return DB::select("SELECT users.alias as admin, users_eventos.evento_id FROM users
                        RIGHT JOIN users_eventos ON users_eventos.user_id = users.id
                        RIGHT JOIN eventos ON users_eventos.evento_id = eventos.id
                        WHERE users_eventos.is_admin_principal = true 
                            AND users_eventos.evento_id IN (SELECT evento_id FROM users_eventos WHERE user_id = ?)
                            AND users_eventos.is_visible = true
                        ORDER BY eventos.id"
                            ,[session('id')]);
    }

    public function getActividadesEventos(){
        return DB::select("SELECT count(actividades.id) as numActividades, eventos.id FROM actividades
                        RIGHT JOIN eventos ON eventos.id = actividades.evento_id
                        RIGHT JOIN users_eventos ON eventos.id = users_eventos.evento_id
                            WHERE users_eventos.user_id = ? AND users_eventos.is_visible = true
                        GROUP BY eventos.id ORDER BY eventos.id",[session('id')]);
    }

    public function getPagadoEventos(){
        return DB::select("SELECT sum(if(gastos.is_aceptado = true, gastos.coste, 0)) as pagado, eventos.id as evento_id FROM gastos
                        RIGHT JOIN eventos ON eventos.id = gastos.evento_id
                        RIGHT JOIN users_eventos ON eventos.id = users_eventos.evento_id
                            WHERE users_eventos.user_id = ? AND users_eventos.is_visible = true
                        GROUP BY eventos.id ORDER BY eventos.id",[session('id')]);
    }
}
