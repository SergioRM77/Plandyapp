<?php

namespace App\View\Components\vistas;

use Illuminate\View\Component;

class ajustes_usuario extends Component
{
    public $users;
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('vistas.ajustes_usuario');
    }

    //AQUI VAN LAS FUNCIONES PARA ELCOMPONENTE, TRATAR DATOS, VISTA, DISEÑO...
}
