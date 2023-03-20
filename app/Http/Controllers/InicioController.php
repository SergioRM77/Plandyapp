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
        $datosEventos = DB::select("SELECT eventos.id, eventos.nombre_evento, eventos.fecha_inicio, eventos.fecha_fin, users.id as IDuser FROM eventos 
                                LEFT JOIN users_eventos ON users_eventos.evento_id = eventos.id
                                LEFT JOIN users ON users_eventos.user_id = users.id
                                WHERE users.id = ? ORDER BY eventos.id", [session('id')]);
        $participantes = DB::select("SELECT count(user_id) as numParticipantes, evento_id FROM users_eventos
                                            RIGHT JOIN eventos ON eventos.id = users_eventos.evento_id
                                            WHERE evento_id IN 
                                                (SELECT evento_id FROM users_eventos WHERE user_id = ?)
                                            GROUP BY evento_id ORDER BY eventos.id",[session('id')]);
        $admins = DB::select("SELECT users.alias as admin, users_eventos.evento_id FROM users
                                        RIGHT JOIN users_eventos ON users_eventos.user_id = users.id
                                        RIGHT JOIN eventos ON users_eventos.evento_id = eventos.id
                                        WHERE users_eventos.is_admin_principal = true 
                                            AND users_eventos.evento_id IN (SELECT evento_id FROM users_eventos WHERE user_id = ?)
                                        ORDER BY eventos.id"
                                            ,[session('id')]);
        $actividades = DB::select("SELECT count(actividades.id) as numActividades, eventos.id FROM actividades
                                    right join eventos on eventos.id = actividades.evento_id
                                    right join users_eventos on eventos.id = users_eventos.evento_id
                                        WHERE users_eventos.user_id = ?
                                    GROUP BY eventos.id ORDER BY eventos.id",[session('id')]);
        $pagado = DB::select("SELECT sum(gastos.coste) as pagado, eventos.id as evento_id FROM gastos
                                        right join eventos on eventos.id = gastos.evento_id
                                        right join users_eventos on eventos.id = users_eventos.evento_id
                                            WHERE users_eventos.user_id = ?
                                        GROUP BY eventos.id ORDER BY eventos.id",[session('id')]);
        $eventos=[];
        for ($i=0; $i < count($datosEventos); $i++) { 
            $eventos[$i] = 
            array_merge((array)$datosEventos[$i],(array)$participantes[$i],
                        (array)$admins[$i],(array)$actividades[$i], (array)$pagado[$i]);
            }
        return view('inicioVista',compact('eventos'));
    }

}
