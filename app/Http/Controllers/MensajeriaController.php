<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Chat_evento;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\User;
use App\Models\User_evento;
use Illuminate\Support\Facades\DB;

class MensajeriaController extends Controller
{
    public function __invoke()
    {
        
        return view('mensajeriaVista');
    }

    public static function verMensajeria(){
        $usuariosChatPrivados = DB::select("SELECT alias, id, localidad, foto, intereses FROM users
                                            WHERE users.id IN (
                                            SELECT IF(usuario_origen_id = ?,  usuario_destino_id, usuario_origen_id) as usuario_id  FROM chat
                                            WHERE usuario_origen_id = ? OR usuario_destino_id = ?
                                            group by usuario_id)", 
                                        [session('id'), session('id'), session('id')]);
        $mensajeriaEventosIDs = DB::select("SELECT evento_id FROM chats_eventos
                                                WHERE usuario_id = ?", [session('id')]);
        return view('mensajeriaVista', compact('usuariosChatPrivados'));
        
    }
}
