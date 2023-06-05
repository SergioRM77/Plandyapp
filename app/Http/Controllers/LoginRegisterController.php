<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validate;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\ImagenesController;
use Exception;

class LoginRegisterController extends Controller
{

    /**
     * Registrar un usuario nuevo
     */
    public function store(Request $request){
        try {
            $request->validate([
                'nombre_completo' => 'required',
                'alias' => 'required|unique:users',
                'email' => 'email|required|unique:users',
                'telefono' => 'max:12',
                'direccion' => 'max:100',
                'localidad' => 'required|max:100',
                'codigo_postal' => 'max:15',
                'intereses' => 'max:200',
                'password' => 'min:6|required_with:confirm-password|same:confirm-password',
                'confirm-password' => 'min:6|required',
                'foto' => 'nullable|image|max:2048'
            ]);

            $usuario = new User();
            $usuario->nombre_completo = $request->nombre_completo;
            $usuario->alias = $request->alias;
            $usuario->email = $request->email;
            $usuario->telefono = $request->telefono;
            $usuario->direccion = $request->direccion;
            $usuario->localidad = $request->localidad;
            $usuario->codigo_postal = $request->codigo_postal;
            $usuario->intereses = $request->intereses;
            if($request->foto != null) $usuario->foto = ImagenesController::guardarImagen($request);
            $usuario->password = bcrypt($request->password);
            $usuario->save();
            $miID = $usuario->id;
            session(['alias' => $request->alias,'id' => $miID,'foto_perfil' => $usuario->foto]);
            session()->flash('status', 'Usuario creado, Bienvenido a PlandyApp');
            Auth::login($usuario);
            return view('inicioVista');
    } catch (Exception $th) {
        session()->flash('status', 'Ha ocurrido un error en el Registro');
        return to_route('login');
    }
    }

    /**
     * Iniciar sesión
     */
    public function storeLogin(Request $request){
        try {
        
            $credentials = $request->validate([
                'alias'=> 'required|exists:users',
                'password' => 'min:6|required'
            ]);
            $miusuario = User::whereAlias($request->alias)->first();
            if ($miusuario->estado != "activo") {
                session()->flash('status', 'Este usuario ya no está activo en el sistema');
                return view("auth.login");
            }
            if (!Auth::attempt($credentials)) {
                return redirect()->intended('login')->with('status', 'Usuario o Contraseña no encontrados');
            }
            
            session(['alias' => $request->alias,'id' => $miusuario->id, 'foto_perfil' => $miusuario->foto]);
            $request->session()->regenerate();
            return redirect()->intended('inicio')->with('status', 'Te has logueado');
        } catch (Exception $th) {
            session()->flash('status', 'Ha ocurrido un error a la hora de Loguearse');
            return to_route('login');
        }
    }

    /**
     * Finalizar sesión
     */
    public function destroySession(Request $request) {
        Auth::guard("web") -> logout();

        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();

        session()->flash('status', 'Sesión cerrada');
        return redirect() -> intended('login');
    }

}
