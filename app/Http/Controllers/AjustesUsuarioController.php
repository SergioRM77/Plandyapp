<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validate;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AjustesUsuarioController extends Controller
{
    public function index(Request $request)
    {

        $user = User::where('alias', session()->get('alias'))->get();
        return view('ajustesUsuario', compact('user'));
    }

    public function update(Request $request){

        $request->validate([
            'nombre_completo' => 'required',
            'telefono' => 'max:12',
            'direccion' => 'max:100',
            'localidad' => 'required|max:100',
            'codigo_postal' => 'max:15',
            'intereses' => 'max:200',
            'password' => 'min:4|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'min:4|required',
            'foto' => ''
        ]);

        $usuario = User::where('alias', session()->get('alias'))->get();
        // $usuario->nombre_completo = $request->input('nombre_completo');
        // $usuario->alias = $request->input('alias');
        // $usuario->email = $request->input('email');
        // $usuario->telefono = $request->input('telefono');
        // $usuario->direccion = $request->input('direccion');
        // $usuario->localidad = $request->input('localidad');
        // $usuario->codigo_postal = $request->input('codigo_postal');
        // $usuario->intereses = $request->input('intereses');
        // $usuario->password = bcrypt($request->input('password'));
        // $usuario->save();

        // // $usuario->nombre_completo = $request->nombre_completo;
        // // $usuario->alias = $request->alias;
        // // $usuario->email = $request->email;
        // // $usuario->telefono = $request->telefono;
        // // $usuario->direccion = $request->direccion;
        // // $usuario->localidad = $request->localidad;
        // // $usuario->codigo_postal = $request->codigo_postal;
        // // $usuario->intereses = $request->intereses;
        // // $usuario->password = bcrypt($request->password);
        // // $usuario->save();

        session(['alias' => $request->alias]);
        session()->flash('status', 'Has actualizado tus datos');
//        return view('inicio');

        return $usuario;

    }
    
}
