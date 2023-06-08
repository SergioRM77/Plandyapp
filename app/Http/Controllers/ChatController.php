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


    /**
     * Abrir chat privado con contacto, ya sea nuevo o con mensajes anteriores
     */
    public function abrirChatPrivado($user, $contacto){
        try {
            
            $contacto = User::select('id','alias', 'foto')->where('alias', $contacto)->first();
            $iscontacto = DB::select("SELECT is_aceptado FROM agregar_aceptar 
                                        WHERE (usuario_agreagador_id = ? AND usuario_agreagado_id = ? AND is_aceptado = TRUE)
                                        OR (usuario_agreagador_id = ? AND usuario_agreagado_id = ? AND is_aceptado = TRUE)", 
                                        [session('id'),$contacto->id, $contacto->id, session('id')]);
            if (count($iscontacto)==0) {
                session()->flash('status', 'No se reconoce como contacto a ese usuario');
                return redirect()->route('inicio');
            }
            $conversacion = DB::select("SELECT * FROM chat
                                            WHERE (usuario_origen_id = ? AND usuario_destino_id = ?)
                                                OR (usuario_origen_id = ? AND usuario_destino_id = ?)
                                                ORDER BY fecha_y_hora ASC",
                                                [session('id'), $contacto->id, $contacto->id, session('id')]);
            
            return view('tiposChat.chatVista', compact('conversacion', 'contacto'));
        } catch (Exception $th) {
            session()->flash('status', 'Ha ocurrido un error');
                    return redirect()->route('inicio');
        }
    }

    /**
     * Enviar mensaje a contacto privado
     */
    public function enviarMensajeChatPrivado(Request $request){
        try {
            $contacto = User::select('id')->where('alias', $request->contacto)->first();
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

    /**
     * Validar mensaje a usuario
     */
    public function validarMensaje(Request $request, int $idContacto){
        return $request->validate(['contenido' => 'required|max:254']) && is_numeric($idContacto);
        
    }

    //CHATS DE EVENTOS

    /**
     * Abrir el chat de evento activo con todos los mensajes grupales
     */
    public function abrirChatEvento($nombre_evento, $id_evento, $user){
        try {
            if ($this->validarAccesoChatEvento($nombre_evento, $id_evento, $user)) {
                $chatEvento = DB::select("SELECT chats_eventos.usuario_id, chats_eventos.evento_id, chats_eventos.fecha_y_hora, 
                                            chats_eventos.contenido, users.alias FROM chats_eventos
                                        LEFT JOIN users ON users.id = chats_eventos.usuario_id
                                    WHERE chats_eventos.evento_id = ? ORDER BY chats_eventos.fecha_y_hora", 
                                    [$id_evento]);
                return view('tiposChat.chatEventoVista', compact('chatEvento', 'nombre_evento', 'id_evento'));
            }
            
            
        } catch (Exception $th) {
            session()->flash('status','No se puede acceder ese chat de evento');
            return redirect()->route('inicio');
        }
        
    }

    /**
     * Validar si este usuario forma parte de este evento
     */
    public function validarAccesoChatEvento($nombre_evento, $id_evento, $user){
        $datos = DB::table("eventos")->where("id", $id_evento)->first();
        return $datos->id == $id_evento && $datos->nombre_evento = $nombre_evento && $user == session('alias');
    }

    /**
     * Enviar mensaje a evento si soy participante
     */
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

    /**
     * Validar datos de mensaje para evento
     */
    public function validarMensajeEvento(Request $request){
        return $request->validate([
            'contenido' => 'required|max:254',
            'nombre_evento' => 'required|max:254',
            'id_evento' => 'required|numeric'
        ]) && $request->user == session('alias');
    }


}
