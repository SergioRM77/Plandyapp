<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agregar_aceptar;
use App\Models\Bloquear_desbloquear;
use Illuminate\Support\Facades\DB;

class ContactosController extends Controller
{
    /**
     * Busqueda de usuario por alias, debe ser nombre completo, no parcial
     */
    public function buscarPorAlias(Request $request){
        $IDusuario=User::whereAlias($request->alias)->get('id');
        $busqueda = $this->datosPorAlias($request->alias);
        if (!is_string($busqueda)) {
            $isContacto = $this->isContactoAceptadoAlias($request->alias);
            $isBloqueadoPorMi = $this->isBloqueadoPorMi($IDusuario[0]->id);
        } else {
            $isContacto = null;
            $isBloqueadoPorMi = null;
        }
        return view('vistasContactos.busquedaVista', compact('busqueda', 'isContacto', 'isBloqueadoPorMi'));
    }

    /**
     * Mostrar todos los usuarios, solo para el admin del sistema
     */
    public function showAllUsers(Request $request){
        $users = User::all()->where('alias', '!=', session()->get('alias'));
        return view('vistasContactos.contactosVista', compact('users'));
    }
    
    /**
     * Mostrar todos mis contactos
     */
    public function mostrarContactos(){
        $contactos = DB::select("SELECT usuario_agreagador_id AS IDsContactos FROM agregar_aceptar WHERE usuario_agreagado_id = ? AND is_aceptado = true
                                UNION SELECT usuario_agreagado_id FROM agregar_aceptar WHERE usuario_agreagador_id = ? AND is_aceptado = true",
                                [session('id'), session('id')]);
        $IDsContactos=[];
        foreach ($contactos as $key => $ids) {
            foreach ($ids as $key => $numID) {
                $IDsContactos[]=$numID;
            }
        }
        $users = User::whereIn('id',$IDsContactos)->get();
        return view('vistasContactos.contactosVista', compact('users'));
    }

    /**
     * Agregar y mandar solicitud de amistad a otro usuario
     */
    public function agregar(Request $request){
        $agregador=session('id');
        $agregado=User::whereAlias($request->alias)->get('id')->first();
        $solicitud = DB::select("SELECT * FROM agregar_aceptar WHERE usuario_agreagador_id 
                                IN (" . $agregador . ", " . $agregado->id . ") AND 
                                usuario_agreagado_id IN (" . $agregador . ", " . $agregado->id . ")");

        if(count($solicitud) > 0){
            session()->flash('status', 'Solicitud en curso');
            return redirect('contactos.miscontactos');
        }

        $agregar = new Agregar_aceptar();
        $agregar->usuario_agreagador_id = $agregador;
        $agregar->usuario_agreagado_id = $agregado->id;
        $agregar->save();
        session()->flash('status', 'Has enviado solicitud');
        return redirect('contactos');
    }

    /**
     * Filtar contactos por, 'solicitudes', 'contactos' o 'bloqueados'
     */
    public function filtrar(Request $request){
        if($request->select == "solicitudes"){
            return $this->solicitudes();
        }elseif ($request->select == 'misContactos') {
            return redirect('contactos');
        }elseif ($request->select == 'bloqueados') {
            return $this->mostrarBloqueados();
        }
    }

    /**
     * Ver mis solicitudes de amistad
     */
    public function solicitudes(){
        $usuario=session('id');
        //dame todos los ids que aparecen en la tabla agregar_aceptar y que aceptado sea false
        $users = DB::select("SELECT  usuario_agreagador_id AS solicitudes FROM agregar_aceptar WHERE usuario_agreagado_id IN (" . $usuario . ")  AND is_aceptado IN (false) UNION
        SELECT  usuario_agreagado_id FROM agregar_aceptar WHERE usuario_agreagador_id IN (" . $usuario . ")  AND is_aceptado IN (false) " );
        
        //dame todos los ids de los agregadores, no los agregados
        $agregadoresID = DB::select("SELECT usuario_agreagador_id FROM agregar_aceptar 
                                    WHERE usuario_agreagador_id = ? OR usuario_agreagado_id = ? 
                                    AND is_aceptado IN (false)",[ $usuario, $usuario]);
        $agregadorID = [];
        foreach ($agregadoresID as $key => $value) {
            $agregadorID[]= $value->usuario_agreagador_id;
        }
        // return $agregadoresID;
        if ($users) {
            foreach ($users as $key => $valores) {

                foreach($valores as $valor){
                    if($valor != $usuario){
                        $allIDs[] = $valor;
                    }
                }
            }
            $solicitudes = User::all()->whereIn('id',$allIDs);
            return view('vistasContactos.solicitudesVista', compact('solicitudes', 'agregadorID'));
        }      
        $solicitudes = 'NOsolicitudes';
        return view('vistasContactos.solicitudesVista', compact('solicitudes', 'agregadorID'));
    }

    /**
     * Aceptar a otro usuario como amistad
     */
    public function aceptar(Request $request){
        $usuario = session('id');
        $otro = User::whereAlias($request->alias)->get('id')->first();
        //dame el quien es agregador, agregado y si es true o false
        $solicitud = DB::select("SELECT usuario_agreagador_id, usuario_agreagado_id, is_aceptado FROM agregar_aceptar
                                WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? 
                                OR usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                                [$otro->id, $usuario,$usuario,$otro->id]);
        
        if($solicitud[0]->is_aceptado == false){
            DB::update("UPDATE agregar_aceptar set is_aceptado = true 
                        WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? 
                        OR usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                        [$otro->id, $usuario,$usuario,$otro->id]);

        if($this->isBloqueadoPorMi($otro->id)){
            DB::delete("DELETE FROM bloquear_desbloquear
            WHERE  usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?
            OR  usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?",
            [session('id'), $otro->id, $otro->id, session('id')]);
        }
            return $this->solicitudes();
        }
    }

    /**
     * Eliminar a contacto o solicitud de amistad
     */
    public function eliminar(Request $request){
        $usuario = session('id');
        $contacto=User::whereAlias($request->alias)->get('id')->first();
        $exiteEnTabla = DB::select("SELECT usuario_agreagador_id, usuario_agreagado_id, is_aceptado FROM agregar_aceptar
                                WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? 
                                OR usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                                [$contacto->id, $usuario, $usuario, $contacto->id]);
        if($exiteEnTabla == null){
            return $this->mostrarContactos();
        }
        DB::delete("DELETE FROM agregar_aceptar
                    WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? 
                    OR usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                    [$contacto->id, $usuario, $usuario, $contacto->id]);
        return $this->mostrarContactos();
    }

    /**
     * Mostrar usuarios bloqueados
     */
    public function mostrarBloqueados(){
        $bloqueadosID = DB::select("SELECT usuario_bloqueado_id  FROM bloquear_desbloquear 
                                    WHERE usuario_bloqueador_id = ?",[session('id')]);

        $soloIDsBloqueados = [];
        $bloqueados=[];
        if(count($bloqueadosID)>0){
            foreach ($bloqueadosID as $key => $ids) {
                foreach ($ids as $key => $id) {
                    $soloIDsBloqueados[]=$id;
                }
            }
            $bloqueados = User::all()->whereIn('id',$soloIDsBloqueados);
        }
        return view('vistasContactos.bloqueadosVista', compact('bloqueados'));
    }

    /**
     * Bloquear a usuario o contacto
     */
    public function bloquear(Request $request){
        $idABloquear = User::whereAlias($request->alias)->get('id')->first();
        $exist_bloqueado = DB::select("SELECT usuario_bloqueador_id, usuario_bloqueado_id FROM bloquear_desbloquear
                    WHERE usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?
                    OR  usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?",
                    [session('id'), $idABloquear->id, $idABloquear->id, session('id')]);
        
        if($this->isInAgregarAceptar(session('id'), $idABloquear->id)){
            DB::delete("DELETE FROM agregar_aceptar
                    WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? 
                    OR usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                    [session('id'), $idABloquear->id, $idABloquear->id, session('id')]);
        }
        if(count($exist_bloqueado)>0){
            return $this->mostrarBloqueados();
        }
        $bloqueo = new Bloquear_desbloquear();
        $bloqueo->usuario_bloqueador_id= session('id');
        $bloqueo->usuario_bloqueado_id= $idABloquear->id;
        $bloqueo->save();
        return $this->mostrarContactos();
    }

    /**
     * Desbloquear a usuario o contacto
     */
    public function desbloquear(Request $request){
        $idADesbloquear = User::whereAlias($request->alias)->get('id')->first();
        $exist_bloqueado = DB::select("SELECT usuario_bloqueador_id, usuario_bloqueado_id FROM bloquear_desbloquear
                    WHERE usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?
                    OR  usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?",
                    [session('id'), $idADesbloquear->id, $idADesbloquear->id, session('id')]);
        if(count($exist_bloqueado)<0){
            return $this->mostrarBloqueados();
        }
        DB::delete("DELETE FROM bloquear_desbloquear
                    WHERE  usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?
                    OR  usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?",
                    [session('id'), $idADesbloquear->id, $idADesbloquear->id, session('id')]);
        
        return $this->mostrarBloqueados();

    }
/**
 * Mostrar datos de usuario por alias
 */
    private function datosPorAlias($alias){
        $usuario = User::all()->where('alias', '=', $alias);
        if (count($usuario) >0) {
            return $usuario;
        }
        return "No se ha encontrado coincidencias";
    }

    /**
     * Comprobar si un contacto es acepato según el alias
     */
    private function isContactoAceptadoAlias($alias){
        $IDbuscado = User::whereAlias($alias)->get('id')->first();
        $IDmio = session('id');
        $isContacto=DB::select("SELECT is_aceptado FROM agregar_aceptar 
                                WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? OR
                                usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                                [$IDbuscado->id, $IDmio, $IDmio, $IDbuscado->id]);
        if(!empty($isContacto)){
            return $isContacto[0]->is_aceptado;
        }
        return false;
    }

    /**
     * Comprobar si existe dos usuarios en tabla agregar_aceptar, según el alias
     */
    private function isInAgregarAceptar($id1, $id2){
        $isContacto=DB::select("SELECT is_aceptado FROM agregar_aceptar 
                                WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? OR
                                usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                                [$id1, $id2,$id2,$id1]);
        if(count($isContacto)>0){
            return true;
        }
        return false;
    }

    /**
     * Comprobar si el contacto está bloqueado por mi
     */
    private function isBloqueadoPorMi($idAConsultar){
        $isbloqueado = DB::select("SELECT usuario_bloqueador_id, usuario_bloqueado_id FROM bloquear_desbloquear
                                WHERE usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?",
                                [session('id'), $idAConsultar]);
        if(count($isbloqueado)>0){
        return true;
        }
        return false;
    }
}
