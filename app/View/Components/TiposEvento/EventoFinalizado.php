<?php

namespace App\View\Components\TiposEvento;

use Illuminate\View\Component;

class EventoFinalizado extends Component
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

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tipos-evento.evento-finalizado');
    }
}
