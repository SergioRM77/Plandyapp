<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MyForm extends Component
{
    public $user;

    public function __construct()
    {
        $this->user = User::whereAlias(session()->get('alias'))->get()->first();
    }

    public function render()
    {
        return view('components.my-form');
    }

    /**SI LLAMO A ESTOS METODOS NO TENGO POR QUÉ PASAR POR RUTAS */
    public function enviar()
    {
        return action([self::class, 'handle']);
    }

    public function enviarLogin()
    {
        return action([self::class, 'storeLogin']);
    }

    public function logout()
    {
        return action([self::class, 'destroySession']);
    }

    public function update()
    {
        return action([self::class, 'updateData']);
    }

    public function deleteUser()
    {
        return action([self::class, 'delete']);
    }

    /**FIN */

    public function handle(Request $request)
    {
        //Log::info('submit', $request->all());
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

        session(['alias' => $request->alias]);
        session()->flash('status', 'Usuario creado, Bienvenido a PlandyApp');
        Auth::login($usuario);
        return view('inicio');

        //return $request;
    }

    

    public function storeLogin(Request $request){
        $credentials = $request->validate([
            'alias'=> 'required|exists:users',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return redirect()->intended('login')->with('status', 'Usuario o Contraseña no encontrados');
        }
        session(['alias' => $request->alias]);
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

    public function updateData(Request $request){

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

        $usuario = User::whereAlias(session()->get('alias'))->get()->first();

        $usuario->nombre_completo = $request->input('nombre_completo');
        $usuario->telefono = $request->input('telefono');
        $usuario->direccion = $request->input('direccion');
        $usuario->localidad = $request->input('localidad');
        $usuario->codigo_postal = $request->input('codigo_postal');
        $usuario->intereses = $request->input('intereses');
        $usuario->password = bcrypt($request->input('password'));
        $usuario->save();

        session(['alias' => $request->alias]);
        session()->flash('status', 'Has actualizado tus datos');
        return view('inicio');

    }
    public function show($string){
        if($this->user == null){
            return '';
        }
        return $this->user[$string];
    }

    public function delete(){
        $user = User::whereAlias(session()->get('alias'))->get()->first();
        session()->forget('alias');
        $user->delete();
        return to_route('login')->with('status', 'Cuenta de Usuario Eliminada');
    }
}
