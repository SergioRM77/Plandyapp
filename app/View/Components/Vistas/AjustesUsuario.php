<?php

namespace App\View\Components\Vistas;

use Illuminate\View\Component;
use App\Models\User;
use Illuminate\Http\Request;

class AjustesUsuario extends Component
{

    public $user;
    public function __construct($user)
    {
        $this->user = $user[0];
    }


    public function render()
    {
        return view('components.vistas.ajustes-usuario');
    }

    public function show($string = null){
        if($this->user == null){
            return '';
        }
        return $this->user[$string];
    }

}
