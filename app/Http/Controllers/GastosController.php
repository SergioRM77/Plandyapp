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
use App\Http\Controllers\ImagenesController;


class GastosController extends Controller
{

    /**
     * Obtener lista de todos los gastos de un evento por el id
     */
    public function getListaGastos($evento_id){
        return DB::select("SELECT gastos.id, gastos.evento_id, gastos.usuario_id, gastos.descripcion, gastos.coste, gastos.foto, gastos.created_at,  gastos.is_aceptado, users.alias as alias, gastos.foto FROM gastos 
                            LEFT JOIN users ON gastos.usuario_id = users.id  WHERE gastos.evento_id = ? ORDER BY gastos.created_at DESC",[$evento_id]);
    }

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
            $nuevoGasto->foto = ImagenesController::guardarImagen($request);
            $nuevoGasto->save();
            
        } catch (Exception $e) {
            session()->flash('error_gasto',$e->getMessage());
            
        }finally{
            return (new EventoController)->verEventoGet($request->evento_id);

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
            'foto' => 'nullable|image|max:2048'
        ]);
        
    }

    /**
     * Aceptar Gasto para hacerlo visible para usuarios no Administradores
     */
    public function aceptarGasto(Request $request){
        DB::update("UPDATE gastos set is_aceptado = true WHERE gastos.id = ?", [$request->gasto_id]);
        return (new EventoController)->verEventoGet($request->evento_id);
    }

    /**
     * Eliminar gasto por ID de gasto
     */
    public function eliminarGasto(Request $request){
        DB::delete("DELETE FROM gastos WHERE evento_id = ? AND id = ?",[$request->evento_id, $request->gasto_id]);
        return (new EventoController)->verEventoGet($request->evento_id);
    }

    /**
     * Todo lo pagado en evento concreto por el id
     */
    public function pagadoEvento($id){
        session(['pagado' => 0]);
        $pagos = DB::select("SELECT sum(gastos.coste) as pagado, users.id as usuario_id, users.alias FROM gastos 
                            RIGHT JOIN users ON users.id = gastos.usuario_id WHERE evento_id = ? AND is_aceptado = true GROUP BY usuario_id ORDER BY users.id", [$id]);
        $listaParticipantes = DB::select("SELECT user_id as usuario_id, users.alias FROM users_eventos 
                            LEFT JOIN users   ON users.id = users_eventos.user_id WHERE evento_id = ? ORDER BY users.id", [$id]);
        $listaPagos = [];
        foreach ($listaParticipantes as $key1 => $participante) {
            foreach ($pagos as $key2 => $pago) {
                if ($pago->alias == session('alias')) {
                    session(['pagado' => $pago->pagado]);
                }
                if ($participante->usuario_id == $pago->usuario_id ) {
                    $listaPagos[$key1] = (array)$pagos[$key2];
                    break;
                }
                if (!in_array($participante->usuario_id, array_column($pagos, 'usuario_id'))) {
                    $listaPagos[$key1] = ['pagado' => 0,'usuario_id' => $participante->usuario_id,'alias' => $participante->alias ];
                }
            }
        }
        $total = 0;
        foreach ($pagos as $key => $pago) {
            $total += $pago->pagado;
        }
        session(['total' => $total]);
        session(['mediaPagos' => count($pagos) == 0 ? 0 : round(session('total')/count($listaParticipantes),2)]);
        return $listaPagos ;
    }

    public function usuarioDebeUsuario($id){
        $pagos = DB::select("SELECT sum(gastos.coste) as pagado, users.id as usuario_id, users.alias FROM gastos 
                            RIGHT JOIN users ON users.id = gastos.usuario_id WHERE evento_id = ? AND is_aceptado = true GROUP BY usuario_id ORDER BY users.id", [$id]);
        $listaParticipantes = DB::select("SELECT user_id as usuario_id, users.alias FROM users_eventos 
                            LEFT JOIN users   ON users.id = users_eventos.user_id WHERE evento_id = ? ORDER BY users.id", [$id]);
        $listaPagos = [];
        foreach ($listaParticipantes as $key1 => $participante) {
            foreach ($pagos as $key2 => $pago) {
                if ($participante->usuario_id == $pago->usuario_id ) {
                    $listaPagos[$key1] = (array)$pagos[$key2];
                    break;
                }
                if (!in_array($participante->usuario_id, array_column($pagos, 'usuario_id'))) {
                    $listaPagos[$key1] = ['pagado' => 0,'usuario_id' => $participante->usuario_id,'alias' => $participante->alias ];
                }
            }
        }
        return $this->quienDebeQuien($listaPagos);
    }

    public function quienDebeQuien(array $listaPagos){
        $deben = [];
        foreach ($listaPagos as $key => $usuario) {
            $diferencia = session('mediaPagos')-$usuario['pagado'] <0 ? -(session('mediaPagos')-$usuario['pagado']) : session('mediaPagos')-$usuario['pagado'];
            if (($diferencia <= 0.01)) {
                $deben[$key] = "@-" . $usuario['alias'] . " no debe ni le deben dinero.";
            }else{
                if (round($usuario['pagado'],2) > round(session('mediaPagos',2))) {
                $deben[$key] = "@-" . $usuario['alias'] . " ha pagado de más, le deben: " 
                                    . ($usuario['pagado'] - session('mediaPagos')) . "€";
            }
            if (round($usuario['pagado'],2) < round(session('mediaPagos',2))) {
                $deben[$key] = "@-" . $usuario['alias'] . " ha pagado de menos, debe: " 
                                    . session('mediaPagos') - $usuario['pagado'] . "€";
            }
        }
            }
            
        return $deben;
    }

    public function vistaPagoUsuario(Request $request){
        try {
            $request->validate([
                'usuario_id' => 'required|numeric',
                'alias' => 'required',
                'evento_id' => 'required',
                'costeMax' => 'required|numeric|min:1',
                'foto' => 'nullable|image|max:2048'
            ]);
            return view('vistasTiposEvento.pagarAUsuarioVista', compact('request'));
        } catch (Exception $th) {
            session()->flash('status', 'No se puede acceder a pago de usuario');
            return (new EventoController)->verEventoGet($request->evento_id);
        }
    }

    public function pagarUsuario(Request $request){
        try {
            $request->validate([
                'usuario_id' => 'required|numeric',
                'alias' => 'required',
                'evento_id' => 'required',
                'coste' => 'required|numeric|min:1',
                'foto' => 'nullable|image|max:2048'
            ]);
            
            //crear gasto para pagador
            $pago = new Gasto();
            $pago->evento_id = $request->input('evento_id');
            $pago->usuario_id = session('id');
            $pago->coste = $request->input('coste');
            $pago->descripcion = "@-" . session('alias') . ' ha pagado a @-' . $request->alias;
            $pago->foto = $request->input('foto');
            $pago->is_aceptado = true;
            $pago->save();
            //descontar gasto a cobrador
            $descontar = new Gasto();
            $descontar->evento_id = $request->input('evento_id');
            $descontar->usuario_id = $request->input('usuario_id');
            $descontar->coste = -$request->input('coste');
            $descontar->descripcion = "@-" . $request->alias . ' ha recibido un pago de @-' .session('alias') ;
            $descontar->foto = $request->input('foto');
            $descontar->is_aceptado = true;
            $descontar->save();
            session()->flash('status','Has realizado un pago a otro participante de evento');
        } catch (Exception $th) {
            session()->flash('status',$th->getMessage());
        }finally{
            return (new EventoController)->verEventoGet($request->evento_id);
        }
    }


    /* APARTADO DE GASTOS DE PRESUPUESTO */

    /**
     * Obtener lista de gastos en Presupuesto de un evento por el id
     */
    public function getListaGastosPresu($evento_id){
        return DB::select("SELECT gastos_de_presupuesto.id, gastos_de_presupuesto.evento_id, gastos_de_presupuesto.admin_id, 
                                    gastos_de_presupuesto.descripcion_gasto_pre, gastos_de_presupuesto.coste, 
                                    gastos_de_presupuesto.foto, gastos_de_presupuesto.created_at, 
                                    users.alias as alias FROM gastos_de_presupuesto 
                            LEFT JOIN users ON gastos_de_presupuesto.admin_id = users.id  WHERE gastos_de_presupuesto.evento_id = ? ORDER BY gastos_de_presupuesto.created_at DESC",[$evento_id]);
    }

    /**
     * Añadir un gasto para presupuesto
     */
    public function addGastoPresu(Request $request){
        try {
            $this->validarGastosPresu($request);
            $nuevoPresu = new Gasto_de_presupuesto();
            $nuevoPresu->evento_id = $request->evento_id;
            $nuevoPresu->admin_id = session('id');
            $nuevoPresu->coste = $request->coste;
            $nuevoPresu->descripcion_gasto_pre = $request->descripcion_gasto_pre;
            $nuevoPresu->foto = ImagenesController::guardarImagen($request);
            $nuevoPresu->save();
            session()->flash('status',"Se ha añadido un gasto de presupuesto");
        } catch (Exception $e) {
            session()->flash('status',"El campo gasto debe ser mayor a 1 y descripción es obligatorio");
            
        }finally{
            return (new EventoController)->verEventoGet($request->evento_id);
        }
        
    }

    /**
     * Validar datos para Presupuesto
     */
    private function validarGastosPresu(Request $request){        
        return $request->validate([
            'admin_id' => 'required',
            'evento_id' => 'required',
            'descripcion_gasto_pre' => 'required|max:255',
            'coste' => 'required|numeric|min:1',
            'foto' => 'nullable|image|max:2048'
        ]);
        
    }

    /**
     * Eliminar gasto de Presupuesto por ID
     */
    public function eliminarGastoPresu(Request $request){
        DB::delete("DELETE FROM gastos_de_presupuesto WHERE evento_id = ? AND id = ? 
                    AND admin_id = ?",[session('evento_id'), $request->gasto_id, $request->admin_id]);
        return (new EventoController)->verEventoGet($request->evento_id);
    }


}
