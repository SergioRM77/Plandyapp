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
use DateTime;

class ChatController extends Controller
{

    //CHATS PRIVADOS
    public function chatPrivadoEjemplo()
    {
        
        return view('tiposChat.chatVista');
    }

    public function abrirChatPrivado($user, $contacto){
        $contacto = User::select('id','alias', 'foto')->where('alias', $contacto)->first();
        $conversacion = DB::select("SELECT chat.usuario_origen_id, chat.contenido FROM chat
                                        WHERE (usuario_origen_id = ? AND usuario_destino_id = ?)
                                            OR (usuario_origen_id = ? AND usuario_destino_id = ?)
                                            ORDER BY fecha_y_hora ASC",
                                            [session('id'), $contacto->id, $contacto->id, session('id')]);
        
        return view('tiposChat.chatVista', compact('conversacion', 'contacto'));
    }
    // public function abrirChatPrivado(Request $request){
    //     $conversacion = DB::select("SELECT chat.usuario_origen_id, chat.contenido FROM chat
    //                                     WHERE (usuario_origen_id = ? AND usuario_destino_id = ?)
    //                                         OR (usuario_origen_id = ? AND usuario_destino_id = ?)
    //                                         ORDER BY fecha_y_hora ASC",
    //                                         [session('id'), $request->usuario_id, $request->usuario_id, session('id')]);
    //     $alias = User::select('id','alias')->where('id', $request->usuario_id)->first();
    //     // return compact('alias', 'conversacion');
    //     return view('tiposChat.chatVista', compact('conversacion', 'alias'));
    // }

    public function enviarMensajeChatPrivado(Request $request){
        $contacto = User::select('id')->where('alias', $request->contacto)->first();
        try {
            if ($this->validarMensaje($request, $contacto->id)) {
                $mensaje = new Chat();
                $mensaje->usuario_origen_id = session('id');
                $mensaje->usuario_destino_id = $contacto->id;
                $mensaje->contenido = $request->input('contenido');
                $mensaje->fecha_y_hora = now();
                $mensaje->timestamps = false;
                $mensaje->save();
            }
        } catch (Exception $th) {
            session()->flash('status', $th->getMessage());
        }
        return redirect()->route('abrirChatPrivadoGet', [session('alias'), $request->contacto]);
        
        

    }

    public function validarMensaje(Request $request, int $idContacto){

        return $request->validate(['contenido' => 'required|max:254']) && is_numeric($idContacto);
        
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
