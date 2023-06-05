<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validate;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\ImagenesController;
use App\Http\Controllers\InicioController;

class AjustesUsuarioController extends Controller
{
    /**
     * Mostrar vista usuario con sus datos
     */
    public function ajustes(Request $request){
        $user = User::where('alias', session()->get('alias'))->get();
        return view('ajustesUsuarioVista', compact('user'));
    }

    /**
     * Actualizar datos de usuario
     */
    public function update(Request $request){
        if($this->validateUser($request)){
            $usuario = User::whereAlias(session()->get('alias'))->first();

            $usuario->nombre_completo = $request->input('nombre_completo');
            $usuario->telefono = $request->input('telefono');
            $usuario->direccion = $request->input('direccion');
            $usuario->localidad = $request->input('localidad');
            $usuario->codigo_postal = $request->input('codigo_postal');
            $usuario->intereses = $request->input('intereses');
            if($request->foto != null) $usuario->foto = ImagenesController::guardarImagen($request);
            $usuario->password = bcrypt($request->input('password'));
            $usuario->save();

            session(['alias' => $usuario->alias, 'foto_perfil' => $usuario->foto]);
            session()->flash('status', 'Has actualizado tus datos');
            return (new InicioController)->inicio();
        }

        session()->flash('status', "La contraseña debe tener al menos 6 caracteres con letras números y símbolos");
        return to_route('inicio');

    }

    /**
     * Validación de datos de usuario
     */
    private function validateUser(Request $request){
        return  $request->validate([
                    'nombre_completo' => 'required',
                    'telefono' => 'max:12',
                    'direccion' => 'max:100',
                    'localidad' => 'required|max:100',
                    'codigo_postal' => 'max:15',
                    'intereses' => 'max:200',
                    'password' => 'min:6|required_with:confirm-password|same:confirm-password',
                    'confirm-password' => 'min:6|required',
                    'foto' => 'nullable|image|max:2048'
                ]);
    }
    
    /**
     * Borrar cuenta de usuario
     */
    public function deleteUser(){
        $user = User::whereAlias(session()->get('alias'))->get()->first();
        session()->forget('alias');
        $user->estado = "inactivo";
        $user->save();
        return route('login');
    }
}
