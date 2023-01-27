<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chatEventoController extends Controller
{
    public function __invoke()
    {
        
        return view('tiposChat.chatEvento');
    }
}
