<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Evento;
use App\Models\Gasto;
use App\Models\Gasto_de_presupuesto;
use App\Models\User;
use App\Models\User_evento;
use App\Models\Usuario_participa_actividad;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Http\Controllers\EventoController;


class GastosController extends Controller
{
    /**
     * Presentar un nuevo gasto
     */
    public function addGasto(Request $request){
        try {
            $this->validarGastos($request);
            $nuevoGasto = new Gasto();
            $nuevoGasto->evento_id = $request->evento_id;
            $nuevoGasto->usuario_id = session('id');
            $nuevoGasto->coste = $request->coste;
            $nuevoGasto->descripcion = $request->descripcion;
            $nuevoGasto->save();
            
        } catch (Exception $e) {
            session()->flash('error_gasto',"El campo gasto debe ser mayor a 1 y descripción es obligatorio");
            
        }finally{
            $request = new Request(['id' => $request->evento_id]);
            return (new EventoController)->verEvento($request);

        }
        
    }

    /**
     * Validar datos de un gasto
     */
    private function validarGastos(Request $request){        
        return $request->validate([
            'evento_id' => 'required',
            'descripcion' => 'required|max:255',
            'coste' => 'required|numeric|min:1',
            'foto' => '',
        ]);
        
    }

    /**
     * Aceptar Gasto para hacerlo visible para usuarios no Administradores
     */
    public function aceptarGasto(Request $request){
        DB::update("UPDATE gastos set is_aceptado = true WHERE gastos.id = ?", [$request->gasto_id]);
        $request = new Request(['id' => $request->evento_id]);
        return (new EventoController)->verEvento($request);
    }

    /**
     * Eliminar gasto por ID de gasto
     */
    public function eliminarGasto(Request $request){
        DB::delete("DELETE FROM gastos WHERE evento_id = ? AND id = ?",[$request->evento_id, $request->gasto_id]);
        $request = new Request(['id' => $request->evento_id]);
        return (new EventoController)->verEvento($request);
    }

    /**
     * Todo lo pagado en evento concreto por el id
     */
    public function pagadoEvento($id){
        session(['pagado' => 0]);
        $pagos = DB::select("SELECT sum(gastos.coste) pagado, usuario_id, users.alias FROM gastos 
                            RIGHT JOIN users ON users.id = gastos.usuario_id WHERE evento_id = ? AND is_aceptado = true GROUP BY usuario_id", [$id]);
        $total = 0;
        foreach ($pagos as $key => $pago) {
            if ($pago->alias == session('alias')) {
                session(['pagado' => $pago->pagado]);
            }
        $total += $pago->pagado;
        }
        session(['mediaPagos' => count($pagos) == 0 ? 0 : $total/count($pagos), 'total' => $total]);
        return $pagos;
    }
}
