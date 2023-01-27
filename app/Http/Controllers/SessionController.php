<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function setSessionData(Request $request)
    {
        $request->session()->put('web', 'www.ronbd.com');

        dd('Data has been added to your session');
}

    public function getAccessSession(Request $request)
    {
        $value =  $request->session()->get('web');

        if ($request->session()->has('web')) {
            dd($value);
        } else {
            dd('Nothing to show in this session');
        }
    }

    public function deleteSetSessionData(Request $request)
    {
        $request->session()->forget('web');
        dd('Data has been removed from your session');
    }
}


