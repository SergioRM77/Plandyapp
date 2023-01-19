<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function __invoke(){
        //$user = User::all();
        $user = User::paginate(2);
        return view('welcome', compact('user'));
    }
}
