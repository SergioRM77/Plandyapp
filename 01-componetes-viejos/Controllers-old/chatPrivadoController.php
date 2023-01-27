<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chatPrivadoController extends Controller
{
    public function __invoke()
    {
        
        return view('tiposChat.chat');
    }
}
