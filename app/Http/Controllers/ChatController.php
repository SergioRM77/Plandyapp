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
            date_default_timezone_set('Europe/Madrid');
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

    public function abrirChatEvento($nombre_evento, $id_evento, $user){
        try {//arreglar user alias!!
            if ($this->validarAccesoChatEvento($nombre_evento, $id_evento, $user)) {
                $chatEvento = DB::select("SELECT chats_eventos.usuario_id, chats_eventos.evento_id, chats_eventos.fecha_y_hora, 
                                            chats_eventos.contenido, users.alias FROM chats_eventos
                                        LEFT JOIN users ON users.id = chats_eventos.usuario_id
                                    WHERE chats_eventos.evento_id = ? ORDER BY chats_eventos.fecha_y_hora", 
                                    [$id_evento]);
                return view('tiposChat.chatEventoVista', compact('chatEvento', 'nombre_evento', 'id_evento'));
            }
            
            
        } catch (Exception $th) {
            session()->flash('status','Ha ocurrido un error');
            return redirect()->route('inicio');
        }
        
    }

    public function validarAccesoChatEvento($nombre_evento, $id_evento, $user){
        $datos = DB::table("eventos")->where("id", $id_evento)->first();
        return $datos->id == $id_evento && $datos->nombre_evento = $nombre_evento && $user == session('alias');
    }

    public function enviarMensajeChatEvento(Request $request){
        try {
            date_default_timezone_set('Europe/Madrid');
            $this->validarMensajeEvento($request);
            $mensajeEvento = new Chat_evento();
            $mensajeEvento->evento_id = $request->input('id_evento');
            $mensajeEvento->usuario_id = session('id');
            $mensajeEvento->contenido = $request->input('contenido');
            $mensajeEvento->fecha_y_hora = now();
            $mensajeEvento->timestamps = false;
            $mensajeEvento->save();
            return redirect()->route('chatevento', [
                        'nombre_evento' => $request->nombre_evento, 
                        'id_evento' => $request->id_evento, 
                        'user' => session('alias')]);
        } catch (Exception $th) {
            session()->flash('status', $th->getMessage());
        }
        return redirect()->route('inicio');
    }

    public function validarMensajeEvento(Request $request){
        return $request->validate([
            'contenido' => 'required|max:254',
            'nombre_evento' => 'required|max:254',
            'id_evento' => 'required|numeric'
        ]) && $request->user == session('alias');
    }

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
