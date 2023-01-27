<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function __invoke()
    {
        
        return view('inicio');
    }
}
