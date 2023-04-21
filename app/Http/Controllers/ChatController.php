<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Chat_evento;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\User;
use App\Models\User_evento;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\ControllersMensajeriaController;

class ChatController extends Controller
{

    //CHATS PRIVADOS
    public function chatPrivadoEjemplo()
    {
        
        return view('tiposChat.chatVista');
    }

    public function abrirChatPrivado(Request $request){
        $conversacion = DB::select("SELECT chat.usuario_origen_id, chat.usuario_destino_id FROM chat
                                        WHERE (usuario_origen_id = ? AND usuario_destino_id = ?)
                                            OR (usuario_origen_id = ? AND usuario_destino_id = ?)",
                                            [session('id'), $request->usuario_id, $request->uauario_id, session('id')]);
        $alias = DB::select("SELECT users.id, users.alias FROM users
                                WHERE users.id = ?", [session('id')]);
        
        return view('tiposChat.chatVista', compact('conversacion', 'alias'));
    }

    public function enviarMensajeChatPrivado(Request $request){
        try {
            if ($this->validarMensaje($request)) {
                $mensaje = new Chat();
                $mensaje->usuario_origen_id = session('id');
                $mensaje->usuario_destino_id = $request->input('usuario_id');
                $mensaje->contenido = $request->input('contenido');
                $mensaje->save();
            }
            return $this->enviarMensajeChatPrivado($request);
        } catch (Exception $th) {
            session()->flash('status', 'No se ha podido enviar mensaje');
            return MensajeriaController::verMensajeria();
        }
        
        
        

    }

    public function validarMensaje(Request $request){
        return $request->validate([
            'contenido' => 'required|max:254',
            'usuario_id' => 'required|numeric'
        ]);
    }

    //CHATS DE EVENTOS
    public function chatEvento()
    {
        
        return view('tiposChat.chatEventoVista');
    }

    //CHATS DE REPORTE
    public function chatReporte()
    {
        
        return view('tiposChat.chatReporteVista');
    }
}
