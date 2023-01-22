<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class tabla2 extends Component
{
    public $titulo;
    public $subtitulo;
    public $numUno;
    public $numDos;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($titulo = "", $subtitulo= "", $numUno= 0, $numDos=0)
    {
        $this->titulo= $titulo;
        $this->subtitulo= $subtitulo;
        $this->numUno=$numUno;
        $this->numDos=$numDos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tabla2');
    }
}
