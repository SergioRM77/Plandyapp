<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjustesUsuarioController extends Controller
{
    public function __invoke()
    {
        
        return view('ajustes_usuario');
    }
}
