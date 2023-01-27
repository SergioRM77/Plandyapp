<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chatPrivado()
    {
        
        return view('tiposChat.chat');
    }

    public function chatEvento()
    {
        
        return view('tiposChat.chatEvento');
    }

    public function chatReporte()
    {
        
        return view('tiposChat.chatReporte');
    }
}
