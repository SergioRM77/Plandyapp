<?php

namespace App\View\Components\Vistas;

use Illuminate\View\Component;

class Contactos extends Component
{
        /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function hola(){
            return "hola";
        }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.vistas.contactos');
    }
}
