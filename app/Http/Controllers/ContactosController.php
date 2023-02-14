<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agregar_aceptar;
use App\Models\Bloquear_desbloquear;
use Illuminate\Support\Facades\DB;

class ContactosController extends Controller
{

    /*METER ID DEL USUARIO EN VEZ DE ALIAS EN LO QUE DEVUELVE BOTONES. AHORRAS UNA CONSULTA*/

    public function buscarPorAlias(Request $request){
        $IDusuario=User::whereAlias($request->alias)->get('id');
        $busqueda = $this->datosPorAlias($request->alias);
        $isContacto = $this->isContactoAceptadoAlias($request->alias);
        $isBloqueadoPorMi = $this->isBloqueadoPorMi($IDusuario[0]->id);

        return view('vistasContactos.busqueda', compact('busqueda', 'isContacto', 'isBloqueadoPorMi'));
    }

    public function showAllUsers(Request $request)
    {
        $users = User::all()->where('alias', '!=', session()->get('alias'));
        return view('vistasContactos.contactos', compact('users'));
    }
    
    public function mostrarContactos(){
        $usuario=User::whereAlias(session('alias'))->get('id');
        $contactos = DB::select("SELECT usuario_agreagador_id AS IDsContactos FROM agregar_aceptar WHERE usuario_agreagado_id = ? AND is_aceptado = true
                                UNION SELECT usuario_agreagado_id FROM agregar_aceptar WHERE usuario_agreagador_id = ? AND is_aceptado = true",
                                [$usuario[0]->id , $usuario[0]->id]);
        $IDsContactos=[];
        foreach ($contactos as $key => $ids) {
            foreach ($ids as $key => $numID) {
                $IDsContactos[]=$numID;
            }
        }
        $users = User::whereIn('id',$IDsContactos)->get();
        return view('vistasContactos.contactos', compact('users'));
    }
    public function agregar(Request $request){
        $agregador=User::whereAlias(session('alias'))->get('id');
        $agregado=User::whereAlias($request->alias)->get('id');
        $solicitud = DB::select("SELECT * FROM agregar_aceptar WHERE usuario_agreagador_id 
                                IN (" . $agregador[0] -> id . ", " . $agregado[0] -> id . ") AND 
                                usuario_agreagado_id IN (" . $agregador[0] -> id . ", " . $agregado[0] -> id . ")");

        if(count($solicitud) > 0){
            session()->flash('status', 'Solicitud en curso');
            return redirect('contactos.miscontactos');
        }

        $agregar = new Agregar_aceptar();
        $agregar->usuario_agreagador_id = $agregador[0]->id;
        $agregar->usuario_agreagado_id = $agregado[0]->id;
        $agregar->save();
        session()->flash('status', 'Has enviado solicitud');
        return redirect('contactos');
    }

    public function filtrar(Request $request){
        if($request->select == "solicitudes"){
            return $this->solicitudes();
        }elseif ($request->select == 'misContactos') {
            return redirect('contactos');
        }elseif ($request->select == 'bloqueados') {
            return $this->mostrarBloqueados();
        }
    }

    public function solicitudes(){
        $usuario=User::whereAlias(session('alias'))->get('id');
        //dame todos los ids que aparecen en la tabla agregar_aceptar y que aceptado sea false
        $users = DB::select("SELECT  usuario_agreagador_id AS solicitudes FROM agregar_aceptar WHERE usuario_agreagado_id IN (" . $usuario[0] -> id . ")  AND is_aceptado IN (false) UNION
        SELECT  usuario_agreagado_id FROM agregar_aceptar WHERE usuario_agreagador_id IN (" . $usuario[0] -> id . ")  AND is_aceptado IN (false) " );
        
        //dame todos los ids de los agregadores, no los agregados
        $agregadoresID = DB::select("SELECT usuario_agreagador_id FROM agregar_aceptar 
                                    WHERE usuario_agreagador_id = ? OR usuario_agreagado_id = ? 
                                    AND is_aceptado IN (false)",[ $usuario[0] -> id, $usuario[0] -> id]);
        $agregadorID = [];
        foreach ($agregadoresID as $key => $value) {
            $agregadorID[]= $value->usuario_agreagador_id;
        }
        // return $agregadoresID;
        if ($users) {
            foreach ($users as $key => $valores) {

                foreach($valores as $valor){
                    if($valor != $usuario[0]->id){
                        $allIDs[] = $valor;
                    }
                }
            }
            $solicitudes = User::all()->whereIn('id',$allIDs);
            return view('vistasContactos.solicitudes', compact('solicitudes', 'agregadorID'));
        }      
        $solicitudes = 'NOsolicitudes';
        return view('vistasContactos.solicitudes', compact('solicitudes', 'agregadorID'));
    }

    public function aceptar(Request $request){
        $usuario=User::whereAlias(session('alias'))->get('id');
        $otro=User::whereAlias($request->alias)->get('id');
        //dame el quien es agregador, agregado y si es true o false
        $solicitud = DB::select("SELECT usuario_agreagador_id, usuario_agreagado_id, is_aceptado FROM agregar_aceptar
                                WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? 
                                OR usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                                [$otro[0]->id, $usuario[0]->id,$usuario[0]->id,$otro[0]->id]);
        
        if($solicitud[0]->is_aceptado == false){
            DB::update("UPDATE agregar_aceptar set is_aceptado = true 
                        WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? 
                        OR usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                        [$otro[0]->id, $usuario[0]->id,$usuario[0]->id,$otro[0]->id]);
            return $this->solicitudes();
        }
    }

    public function eliminar(Request $request){
        $usuario=User::whereAlias(session('alias'))->get('id');
        $contacto=User::whereAlias($request->alias)->get('id');
        $exiteEnTabla = DB::select("SELECT usuario_agreagador_id, usuario_agreagado_id, is_aceptado FROM agregar_aceptar
                                WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? 
                                OR usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                                [$contacto[0]->id, $usuario[0]->id,$usuario[0]->id,$contacto[0]->id]);
        if($exiteEnTabla == null){
            return $this->mostrarContactos();
        }
        DB::delete("DELETE FROM agregar_aceptar
                    WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? 
                    OR usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                    [$contacto[0]->id, $usuario[0]->id,$usuario[0]->id,$contacto[0]->id]);
        return $this->mostrarContactos();
    }

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
        return view('vistasContactos.bloqueados', compact('bloqueados'));
    }

    public function bloquear(Request $request){
        $idABloquear = User::whereAlias($request->alias)->get('id');
        $exist_bloqueado = DB::select("SELECT usuario_bloqueador_id, usuario_bloqueado_id FROM bloquear_desbloquear
                    WHERE usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?
                    OR  usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?",
                    [session('id'), $idABloquear[0]->id, $idABloquear[0]->id, session('id')]);
        if(count($exist_bloqueado)>0){
            return $this->mostrarBloqueados();
        }
        if($this->isInAgregarAceptar(session('id'), $idABloquear[0]->id)){
            DB::delete("DELETE FROM agregar_aceptar
                    WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? 
                    OR usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                    [session('id'), $idABloquear[0]->id,$idABloquear[0]->id,session('id')]);
        }
        
        $bloqueo = new Bloquear_desbloquear();
        $bloqueo->usuario_bloqueador_id= session('id');
        $bloqueo->usuario_bloqueado_id= $idABloquear[0]->id;
        $bloqueo->save();
        return $this->mostrarContactos();
    }

    public function desbloquear(Request $request){
        $idADesbloquear = User::whereAlias($request->alias)->get('id');
        $exist_bloqueado = DB::select("SELECT usuario_bloqueador_id, usuario_bloqueado_id FROM bloquear_desbloquear
                    WHERE usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?
                    OR  usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?",
                    [session('id'), $idADesbloquear[0]->id, $idADesbloquear[0]->id, session('id')]);
        if(count($exist_bloqueado)<0){
            return $this->mostrarBloqueados();
        }
        DB::delete("DELETE FROM bloquear_desbloquear
                    WHERE  usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?
                    OR  usuario_bloqueador_id = ? AND usuario_bloqueado_id = ?",
                    [session('id'), $idADesbloquear[0]->id, $idADesbloquear[0]->id, session('id')]);
        
        return $this->mostrarBloqueados();

    }

    private function datosPorAlias($alias){
        $usuario = User::all()->where('alias', '=', $alias);
        if (count($usuario) >0) {
            return $usuario;
        }
        return "No Existe usuario";
    }

    private function isContactoAceptadoAlias($alias){
        $IDbuscado = User::whereAlias($alias)->get('id');
        $IDmio = User::whereAlias(session('alias'))->get('id');
        $isContacto=DB::select("SELECT is_aceptado FROM agregar_aceptar 
                                WHERE usuario_agreagador_id = ? AND usuario_agreagado_id = ? OR
                                usuario_agreagador_id = ? AND usuario_agreagado_id = ?",
                                [$IDbuscado[0]->id, $IDmio[0]->id,$IDmio[0]->id,$IDbuscado[0]->id]);
        if(!empty($isContacto)){
            return $isContacto[0]->is_aceptado;
        }
        return false;
    }
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
