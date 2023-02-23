<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validate;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRegisterController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'nombre_completo' => 'required',
            'alias' => 'required|unique:users',
            'email' => 'email|required|unique:users',
            'telefono' => 'max:12',
            'direccion' => 'max:100',
            'localidad' => 'required|max:100',
            'codigo_postal' => 'max:15',
            'intereses' => 'max:200',
            'password' => 'min:4|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'min:4|required',
            'foto' => ''
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
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        $miID = $usuario->id;
        session(['alias' => $request->alias,'id' => $miID]);
        session()->flash('status', 'Usuario creado, Bienvenido a PlandyApp');
        Auth::login($usuario);
        return view('inicio');
    }
    public function storeLogin(Request $request){
        $credentials = $request->validate([
            'alias'=> 'required|exists:users',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return redirect()->intended('login')->with('status', 'Usuario o Contraseña no encontrados');
        }
        $miID = User::whereAlias($request->alias)->get('id');
        session(['alias' => $request->alias,'id' => $miID[0]->id]);
        $request->session()->regenerate();
        return redirect()->intended('inicio')->with('status', 'Te has logueado');
    }

    public function destroySession(Request $request) {
        Auth::guard("web") -> logout();

        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();

        session()->flash('status', 'Sesión cerrada');
        return redirect() -> intended('login');
    }

}
