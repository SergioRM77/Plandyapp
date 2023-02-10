<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agregar_aceptar;
use Illuminate\Support\Facades\DB;

class ContactosController extends Controller
{
    public function showAllUsers(Request $request)
    {
        $users = User::all()->where('alias', '!=', session()->get('alias'));

        return view('contactos', compact('users'));
    }

    public function addContact(Request $request){

        $agregador=User::whereAlias(session('alias'))->get('id');
        $agregado=User::whereAlias($request->alias)->get('id');

        $solicitud = DB::select("SELECT * FROM agregar_aceptar WHERE usuario_agreagador_id IN (" . $agregador[0] -> id . ", " . $agregado[0] -> id . ") AND usuario_agreagado_id IN (" . $agregador[0] -> id . ", " . $agregado[0] -> id . ")");

        if(count($solicitud) > 0){
            session()->flash('status', 'Solicitud en curso');
            return redirect('contactos');
        }

        $agregar = new Agregar_aceptar();
        $agregar->usuario_agreagador_id = $agregador[0]->id;
        $agregar->usuario_agreagado_id = $agregado[0]->id;
        $agregar->save();
        session()->flash('status', 'Has enviado solicitud');
        return redirect('contactos');

    }

    
}
