<?php

namespace App\View\Components\Vistas;

use Illuminate\View\Component;
use App\Models\User;
use Illuminate\Http\Request;

class AjustesUsuario extends Component
{

    public $user;
    public function __construct($user)
    {
        $this->user = $user[0];
    }


    public function render()
    {
        return view('components.vistas.ajustes-usuario');
    }

    public function show($string){
        if($this->user == null){
            return '';
        }
        return $this->user[$string];
    }

    public function update(){

        // $request->validate([
        //     'nombre_completo' => 'required',
        //     'telefono' => 'max:12',
        //     'direccion' => 'max:100',
        //     'localidad' => 'required|max:100',
        //     'codigo_postal' => 'max:15',
        //     'intereses' => 'max:200',
        //     'password' => 'min:4|required_with:confirm-password|same:confirm-password',
        //     'confirm-password' => 'min:4|required',
        //     'foto' => ''
        // ]);

        // $usuario = User::where('alias', '=', session()->get('alias'))->get()->first();

        // $usuario->nombre_completo = $request->input('nombre_completo');
        // $usuario->telefono = $request->input('telefono');
        // $usuario->direccion = $request->input('direccion');
        // $usuario->localidad = $request->input('localidad');
        // $usuario->codigo_postal = $request->input('codigo_postal');
        // $usuario->intereses = $request->input('intereses');
        // $usuario->password = bcrypt($request->input('password'));
        // $usuario->save();

        // session(['alias' => $request->alias]);
        // session()->flash('status', 'Has actualizado tus datos');
        // return view('inicio');

    }


}
