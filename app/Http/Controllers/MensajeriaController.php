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

    /**
     * Ver todos los mensajes que hay en mi bandeja de entrada, privados y de evento
     */
    public static function verMensajeria(){
        $usuariosChatPrivados = DB::select("SELECT alias, id, localidad, foto, intereses FROM users
                                            WHERE users.id IN (
                                            SELECT IF(usuario_origen_id = ?,  usuario_destino_id, usuario_origen_id) as usuario_id  FROM chat
                                            WHERE usuario_origen_id = ? OR usuario_destino_id = ?
                                            group by usuario_id)", 
                                        [session('id'), session('id'), session('id')]);
        $mensajeriaEventosIDs = DB::select("SELECT evento_id FROM chats_eventos
                                                WHERE usuario_id = ?", [session('id')]);
        $eventosChat = DB::select("SELECT eventos.id, eventos.nombre_evento FROM eventos
                                        RIGHT JOIN users_eventos ON users_eventos.evento_id = eventos.id
                                        LEFT JOIN users ON users.id = users_eventos.user_id
                                    WHERE users.id = ? AND eventos.is_activo = TRUE", [session('id')]);
        return view('mensajeriaVista', compact('usuariosChatPrivados', 'eventosChat'));
        
    }
}
