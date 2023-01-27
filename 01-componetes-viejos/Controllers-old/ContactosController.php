<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactosController extends Controller
{
    public function __invoke()
    {
        
        return view('contactos');
    }
}
