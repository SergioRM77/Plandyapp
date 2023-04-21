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
        $mensajeriaPrivadaIDs = DB::select("SELECT usuario_origen_id as usuario_id FROM chat
                                                WHERE usuario_destino_id = ?
                                            UNION SELECT ususario_destino_id as usuario_id FROM chat
                                                WHERE  usuario_origen_id = ? ", 
                                        [session('id'), session('id')]);
        $mensajeriaEventosIDs = DB::select("SELECT evento_id FROM chats_eventos
                                                WHERE usuario_id = ?", [session('id')]);
        return view('mensajeriaVista', compact('mensajeriaPrivadaIDs', 'mensajeriaEventosIDs'));
        
    }
}
