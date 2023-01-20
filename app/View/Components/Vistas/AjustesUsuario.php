<?php

namespace App\View\Components\Vistas;

use Illuminate\View\Component;

class AjustesUsuario extends Component
{
    public $users;
    public $usuarios;
    public function __construct($users, $usuarios)
    {
        $this->users = $users;
        $this->usuarios = $usuarios;
        
    }
    public function getAllCodigoPostal(){
        $array='';
            foreach ($this->usuarios as $usuario => $value) {
                $array .= $usuario . $this->usuarios[$usuario]['codigo_postal'] . ' .';
            }
            return $array;

    }

        public function isSelected()
    {
        return "asdfqdgf";
    }
    
    public function render()
    {
        return view('components.vistas.ajustes-usuario');
    }
}
