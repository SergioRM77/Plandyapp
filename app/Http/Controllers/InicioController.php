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
        $eventos = null;
        $eventos = DB::select("SELECT eventos.id, eventos.nombre_evento, eventos.fecha_inicio, eventos.fecha_fin, users.id as IDuser FROM eventos 
                                LEFT JOIN users_eventos ON users_eventos.evento_id = eventos.id
                                LEFT JOIN users ON users_eventos.user_id = users.id
                                WHERE users.id = ?", [session('id')]);
        
        return view('inicio',compact('eventos'));
        // return $misEventos;
    }
}
