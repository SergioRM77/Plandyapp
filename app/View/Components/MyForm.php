<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MyForm extends Component
{
    public function handle(Request $request)
    {
        //Log::info('submit', $request->all());

        return $request;
    }

    public function enviar()
    {
        return action([self::class, 'handle']);
    }

    public function render()
    {
        return view('components.my-form');
    }
}
