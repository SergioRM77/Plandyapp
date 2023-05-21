<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Clave_recuperacion_cuenta;
use Exception;
use Illuminate\Http\Request;
use App\Mail\PlandyAppMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function solicitarCorreoCambioContrasenna(){
        return view('mails.solicitar_cambio_contrasenna');
        //generar vista pendiente para enviar a correo O MODAL 
    }

    /**
     * A través de correo proporcionado se busca en base de datos, si hay coincidencias
     * se envia a correo una clave de solicitud de cambio de contraseña
     */
    public function generarClaveRecuperacion(Request $request){//Request
        try {
            $user = User::where('email', $request->email)->first();
            if($user != null){
                $alias = $user->alias;
                $email = $user->email;
                Clave_recuperacion_cuenta::where('usuario_id', $user->id)->delete();
                $nuevaClave = new Clave_recuperacion_cuenta();
                $nuevaClave->usuario_id = $user->id;
                $nuevaClave->num_recuperacion = sprintf("%06d", random_int(100000, 999999));
                $nuevaClave->save();
                $correo = new PlandyAppMail(
                    "mails.correoSolicitarNuevaPassword",
                    [
                        "codigo" => $nuevaClave->num_recuperacion,
                        "alias" => $alias,
                        "email" => $email
                    ]);
                //IMPORTANTE CAMBIAR POR $user->email
                Mail::to('josepz93perez@gmail.com')->send($correo);
                session()->flash('status', 'Se ha enviado un correo a la cuenta proporcionada
                    para que pueda cambiar la contraseña. Es posible que esté en SPAM');
            }else {
                session()->flash('status', 'No se ha encontrado coincidencias con correo proporcionado
                        inténtelo de nuevo');
            }
            
        } catch (Exception $th) {
            session()->flash('status', $th->getMessage());
        }
        return redirect('login');
    }

    /**
     * Enviar Clave de verificación, correo y alias para realizar el cambio de contraseña
     */
    public function solicitarCambioContrasenna(Request $request){
        try {
            $user = User::where('email', $request->email)->where('alias', $request->alias)->first();
            if($user != null){
                $clave = Clave_recuperacion_cuenta::where('usuario_id', $user->id)->first();
                if($clave->num_recuperacion == $request->codigo){
                    $nuevaPassword = $this->randomPassword();
                    $user->password = bcrypt($nuevaPassword);
                    $user->save();
                    $correo = new PlandyAppMail(
                        "mails.nuevaPassword",
                        [
                            "password" => $nuevaPassword,
                            "alias" => $user->alias,
                            "email" => $user->email
                        ]
                    );
                    //IMPORTANTE CAMBIAR POR $user->email
                    Mail::to("josepz93perez@gmail.com")->send($correo);
                    Clave_recuperacion_cuenta::where('usuario_id', $user->id)->delete();
                    session()->flash('status', 'Se ha enviado un correo a la cuenta proporcionada con la
                                    nueva contraseña');
                }
            }else{
                session()->flash('status', 'No se ha encontrado coincidencias con correo o alias proporcionado');
            }

        }
        catch (Exception $th) {
            session()->flash('status', $th->getMessage());
        }
        return redirect('login');
    }

    public function mostrarDatosCorreo(Request $dato){
        $newPW = $this->randomPassword();
        return view('mails.nuevaPassword', compact('newPW'));
    }


    private function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz/?=_+-ABCDEFGHIJKLMNOPQRSTUVWXYZ/?=_+-1234567890/?=_+-';
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); 
    }

/*************** */
    public function verCorreo(){
        return view('mails.send');
    }
    
}
