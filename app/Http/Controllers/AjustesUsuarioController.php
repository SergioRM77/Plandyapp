<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usuario;

class AjustesUsuarioController extends Controller
{
    public function __invoke()
    {
        $users = User::all();
        $usuarios = Usuario::all();
        return view('ajustesUsuario',compact('users', 'usuarios'));
    }
    
}
