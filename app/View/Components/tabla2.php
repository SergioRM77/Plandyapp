<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tabla2 extends Component
{
    public $titulo;
    public $subtitulo;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($titulo = "", $subtitulo= "")
    {
        $this->titulo= $titulo;
        $this->subtitulo= $subtitulo;
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
