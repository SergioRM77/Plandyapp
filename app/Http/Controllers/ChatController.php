<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chatPrivado()
    {
        
        return view('tiposChat.chatVista');
    }

    public function chatEvento()
    {
        
        return view('tiposChat.chatEventoVista');
    }

    public function chatReporte()
    {
        
        return view('tiposChat.chatReporteVista');
    }
}
