<?php

namespace App\View\Components\Vistas\Botones;

use Illuminate\View\Component;
use App\Models\User;
use App\Models\Agregar_aceptar;
use Illuminate\Support\Facades\DB;

class AgregarEliminar extends Component
{
    public $agregador;
    public $agregado;
    public static $texto = "";
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($agregador, $agregado)
    {
        $this->agregador=$agregador;
        $this->agregado=$agregado;



    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.vistas.botones.agregar-eliminar');
    }

    public function textAceptarCancelarEliminar($aliasAgregado){
        $agregador = User::whereAlias($this->agregador)->get('id');
        $agregado = User::whereAlias($aliasAgregado)->get('id');

        $solicitud = DB::select("SELECT * FROM agregar_aceptar WHERE usuario_agreagador_id IN (" . $agregador[0] -> id . ", " . $agregado[0] -> id . ") AND usuario_agreagado_id IN (" . $agregador[0] -> id . ", " . $agregado[0] -> id . ")");

        if(count($solicitud) == 0){
            return  self::$texto = "Agregar";
        }else if($solicitud[0]->is_aceptado == false){
            return self::$texto = "Aceptar";
        }else if($solicitud[0]->is_aceptado == true){
            return self::$texto = "Eliminar";
        }
        return redirect('contactos');

    }

    public function cambiarColor(){
        if(self::$texto == "Agregar"){
            return "bg-blue-400";
        }else if(self::$texto == "Aceptar"){
            return "bg-green-400";
        }else if(self::$texto == "Eliminar"){
            return "bg-blue-400";
        }
        
    }
    
}
