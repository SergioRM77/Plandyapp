<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AjustesUsuarioController extends Controller
{
    public function __invoke()
    {
        $users = User::all();
        return view('ajustes_usuario',compact('users'));
    }
}
