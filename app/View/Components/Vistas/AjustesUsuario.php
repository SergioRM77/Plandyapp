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
        $texto='';
            foreach ($this->usuarios as $usuario => $value) {
                $texto .= $this->usuarios[$usuario]['nombre_completo'] . 
                ': '. $this->usuarios[$usuario]['codigo_postal'] . ' //';
            }
            return $texto;

    }

        public function isSelected()
    {
        return "Seleccionado";
    }
    
    public function render()
    {
        return view('components.vistas.ajustes-usuario');
    }
}
