<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensajeriaController extends Controller
{
    public function __invoke()
    {
        
        return view('mensajeria');
    }
}