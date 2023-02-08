<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ContactosController extends Controller
{
    public function showAllUsers(Request $request)
    {
        $users = User::all()->where('alias', '!=', session()->get('alias'));
        return view('contactos', compact('users'));
    }
}
