<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class datos extends Component
{
    public $user;
    public function __construct($user)
    {
        $this->user=$user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.datos');
        //return var_dump($this->user);
    }
}
