<?php

namespace App\View\Components;

use App\View\Components\Tabla\test;


use Illuminate\View\Component;

class Tabla extends Component
{
    public $color;
    public $contenido;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($contenido = null, $color = null)
    {

        $this->contenido = $contenido;
        $this->color = $this->elegirColor($contenido, $color);
    
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tabla');
    }


    
    private function elegirColor($valor, $color){
        if (is_numeric($valor)) {
            return "green";
        }if($valor == null){
            return "red";
        }else{
            return $color;
        }
    }

    public function mostrarContenido()
    {
        if (is_numeric($this->contenido)) {
                return $this->tablaMulti();
            if (is_string($this->contenido)) {
                return "es texto no se puede ahcer cálculos";
            }
        }
    }

    private function tablaMulti()
    {

        return $this->contenido . ' * 5 = ' . $this->contenido * 5 . ' / ' .
            $this->contenido . ' * 10 = ' . $this->contenido * 10 . ' / ' .
            $this->contenido . ' * 17 = ' . $this->contenido * 17;
    }

}
