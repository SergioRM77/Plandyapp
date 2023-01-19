<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        //$user = User::all();
        $user = User::all();
        return view('vistaprueba', compact('user'));
    }
    public function componentes(){
        //$user = User::all();
        $user = User::all();
        return view('welcome', compact('user'));
    }
}
