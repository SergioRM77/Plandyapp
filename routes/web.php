<?php

use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\GastosController;
use Illuminate\Support\Facades\Route;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\AjustesUsuarioController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\MensajeriaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ImagenesController;
use App\Http\Controllers\MailController;

use App\Mail\PlandyAppMail;
use Illuminate\Support\Facades\Mail;

use App\View\Components\MyForm;
use App\View\Components\TiposEvento\EventoSinPresu;

Route::get('/',[InicioController::class, 'inicio'])->name('inicio')->middleware('auth');
Route::get('/inicio',[InicioController::class, 'inicio'])->name('inicio')->middleware('auth');

Route::get('samplechat', [ChatController::class, 'chatPrivadoEjemplo'])->name('samplechat');
Route::get('subirfoto', [ImagenesController::class, 'subirImagen'])->name('subir.foto');
Route::post('guardarfoto', [ImagenesController::class, 'guardarImagen'])->name('guardar.foto');
// Route::post('guardarfoto', [ImagenesController::class, 'store'])->name('store.foto');

Route::get('contactos',[ContactosController::class, 'mostrarContactos'])->name('contactos.miscontactos')->middleware('auth');
Route::get('contactosall',[ContactosController::class, 'showAllUsers'])->name('contactos')->middleware('auth');
Route::post('contactos/buscar',[ContactosController::class, 'buscarPorAlias'])->name('contactos.buscar')->middleware('auth');
Route::get('contactos/ver/{alias}',[ContactosController::class, 'buscarPorAlias'])->name('contactos.ver')->middleware('auth');
Route::post('contactos/filtrar',[ContactosController::class, 'filtrar'])->name('contactos.filtrar')->middleware('auth');
Route::post('contactos/agregar',[ContactosController::class, 'agregar'])->name('contactos.agregar')->middleware('auth');
Route::post('contactos/solicitudes',[ContactosController::class, 'solicitudes'])->name('contactos.solicitudes')->middleware('auth');
Route::post('contactos/aceptar',[ContactosController::class, 'aceptar'])->name('contactos.aceptar')->middleware('auth');
Route::post('contactos/eliminar',[ContactosController::class, 'eliminar'])->name('contactos.eliminar')->middleware('auth');
Route::post('contactos/bloquear',[ContactosController::class, 'bloquear'])->name('contactos.bloquear')->middleware('auth');
Route::post('contactos/desbloquear',[ContactosController::class, 'desbloquear'])->name('contactos.desbloquear')->middleware('auth');

Route::get('evento/eventofinalizado',[EventoController::class, 'eventoFinalizado'])->name('eventofinalizado')->middleware('auth');
Route::view('evento/conpresupuesto', 'tiposEvento.eventoConPresu')->name('eventoconpresu')->middleware('auth');
Route::view('evento/sinpresupuesto', 'tiposEvento.eventoSinPresu')->name('eventosinpresu')->middleware('auth');


Route::get('evento/seleccionar-tipo',[EventoController::class, 'selectTipoEvento'])->name('evento.select.tipo')->middleware('auth');
Route::get('evento/crear/{tipo}',[EventoController::class, 'newEvento'])->name('evento.crear')->middleware('auth');
Route::post('evento/crear',[EventoController::class, 'saveEvento'])->name('evento.guardar')->middleware('auth');
Route::post('evento/editar',[EventoController::class, 'editarEvento'])->name('evento.editar')->middleware('auth');
Route::patch('evento/actualizar',[EventoController::class, 'updateEvento'])->name('evento.update')->middleware('auth');
Route::get('evento/ver/{id}',[EventoController::class, 'verEventoGet'])->name('evento.ver.get')->middleware('auth');
Route::get('evento/verget/{id}/{nombre}',[EventoController::class, 'verEventoGet2'])->name('evento.ver.get.get')->middleware('auth');
Route::post('evento/ver',[EventoController::class, 'verEvento'])->name('evento.ver')->middleware('auth');
Route::post('evento/contactos-para-evento/',[EventoController::class, 'verContactosParaEvento'])->name('evento.contactos.ver')->middleware('auth');
Route::post('evento/contactos-add/',[EventoController::class, 'addParticipante'])->name('evento.contactos.add')->middleware('auth');
Route::post('evento/contactos-ver/',[EventoController::class, 'verContactosDeEvento'])->name('evento.contactos.ver')->middleware('auth');
Route::post('evento/contactos-delete/',[EventoController::class, 'eliminarParticipante'])->name('evento.contactos.eliminar')->middleware('auth');
Route::post('evento/contactos-make-admin/',[EventoController::class, 'makeParticipanteAdminSecun'])->name('evento.contactos.makeAdmin')->middleware('auth');
Route::post('evento/contactos-delete-admin/',[EventoController::class, 'eliminarParticipanteAdminSecun'])->name('evento.contactos.deleteAdmin')->middleware('auth');
Route::get('evento/finalizar-evento/',[EventoController::class, 'finalizarEvento'])->name('evento.finalizar')->middleware('auth');
Route::get('evento/eliminar/',[EventoController::class, 'eliminarEvento'])->name('evento.eliminar')->middleware('auth');


Route::post('evento/presentar-gasto',[GastosController::class, 'addGasto'])->name('evento.add.gasto')->middleware('auth');
Route::get('evento/presentar-gasto',[GastosController::class, 'addGasto'])->name('evento.add.gasto')->middleware('auth');
Route::post('evento/aceptar-gasto',[GastosController::class, 'aceptarGasto'])->name('gasto.evento.aceptar')->middleware('auth');
Route::post('evento/elimianr-gasto',[GastosController::class, 'eliminarGasto'])->name('gasto.evento.eliminar')->middleware('auth');
Route::get('evento/pagado',[GastosController::class, 'pagadoEvento'])->name('pagado')->middleware('auth');
Route::get('evento/cuentas/{id}',[GastosController::class, 'usuarioDebeUsuario'])->name('cuentas')->middleware('auth');
Route::post('evento/ventana-pago-a-usuario',[GastosController::class, 'vistaPagoUsuario'])->name('gasto.vista.pago.usuario')->middleware('auth');
Route::post('evento/pago-a-usuario',[GastosController::class, 'pagarUsuario'])->name('gasto.pago.usuario')->middleware('auth');
Route::post('evento/presentar-gasto-presupuesto',[GastosController::class, 'addGastoPresu'])->name('evento.add.gasto.presu')->middleware('auth');
Route::post('evento/eliminar-gasto-presupuesto',[GastosController::class, 'eliminarGastoPresu'])->name('evento.delete.gasto.presu')->middleware('auth');

Route::post('evento/crear-actividad', [ActividadesController::class, 'addActividad'])->name('add.actividad')->middleware('auth');
Route::post('evento/editar-actividad', [ActividadesController::class, 'editarActividad'])->name('editar.actividad')->middleware('auth');
Route::post('evento/actualizar-actividad/', [ActividadesController::class, 'actualizarActividad'])->name('update.actividad')->middleware('auth');
Route::post('evento/eliminar-actividad', [ActividadesController::class, 'eliminarActividad'])->name('delete.actividad')->middleware('auth');
Route::post('evento/add-participante-actividad',  [ActividadesController::class, 'unirseActividad'])->name('add.participante.actividad')->middleware('auth');
Route::post('evento/eliminar-participante-actividad',  [ActividadesController::class, 'salirDeActividad'])->name('delete.participante.actividad')->middleware('auth');

Route::get('mensajeria',[MensajeriaController::class, 'verMensajeria'])->name('mensajeria')->middleware('auth');
// Route::get('mensajeria/chat',[ChatController::class, 'chatPrivado'])->name('chat')->middleware('auth');
Route::get('mensajeria/chat/{user}-{contacto}',[ChatController::class, 'abrirChatPrivado'])->name('abrirChatPrivadoGet')->middleware('auth');
// Route::post('mensajeria/chat',[ChatController::class, 'abrirChatPrivado'])->name('abrirChatPrivado')->middleware('auth');
Route::post('mensajeria/chat/enviar',[ChatController::class, 'enviarMensajeChatPrivado'])->name('enviar.mensaje.privado')->middleware('auth');
Route::get('mensajeria/chat/evento/{nombre_evento}-{id_evento}-{user}',[ChatController::class, 'abrirChatEvento'])->name('chatevento')->middleware('auth');
Route::post('mensajeria/chat/evento/enviar',[ChatController::class, 'enviarMensajeChatEvento'])->name('enviar.mensaje.chat.evento')->middleware('auth');

Route::view('acercade', 'acercadeVista')->name('acercade')->middleware('auth');
Route::view('acercade-info-bienvenida', 'acercadeInfo-Bienvenida')->name('acercade.bienvenida');
Route::get("ajustes", [AjustesUsuarioController::class, 'ajustes'])->name('ajustes')->middleware('auth');
Route::patch("ajustes", [AjustesUsuarioController::class, 'update'])->name('updateUser')->middleware('auth');

Route::view('login','auth.login')->name('login')->middleware('guest');
Route::post('login',[LoginRegisterController::class, 'storeLogin'])->middleware('guest');

Route::view('registrarse','auth.registrarse')->name('registrarse')->middleware('guest');
Route::post('registrarse',[LoginRegisterController::class, 'store'])->middleware('guest');
Route::post('logout',[LoginRegisterController::class, 'destroySession'])->name('logout');
Route::get('logout',[LoginRegisterController::class, 'destroySession'])->name('logout');
Route::delete('borrar-cuenta', [AjustesUsuarioController::class, 'deleteUser'])->name('deleteUser');


Route::get('/setSession', [SessionController::class, 'setSessionData'])->name('setSessionData')->middleware('auth');
Route::get('/getAccessSession', [SessionController::class, 'getAccessSession'])->name('getAccessSession')->middleware('auth');
Route::get('/deleteSessionData', [SessionController::class, 'deleteSetSessionData'])->name('deleteSetSessionData')->middleware('auth');

Route::get('enviarmensaje', function(){
    $correo = new PlandyAppMail('');

    // Mail::to('sr.work.pap01@gmail.com')->send($correo);
    return "mensaje enviado2";
});
Route::get('/datoscorreo', [MailController::class, 'verCorreo'])->name('recibir.correo');
Route::post('/datoscorreo', [MailController::class, 'mostrarDatosCorreo'])->name('mostrar.correo');
Route::post('/correo-nuevo', [MailController::class, 'mostrarDatosCorreo'])->name('nuevo.correo.pass');
Route::post('/solicitud-cambio-password', [MailController::class, 'generarClaveRecuperacion'])->name('solicitud.cambio.password');
Route::post('/nueva-password', [MailController::class, 'solicitarCambioContrasenna'])->name('nueva.password');


// Ejemplo formulario con componentes
Route::view('sample', 'sample');
Route::post('sample/registrarse', [MyForm::class, 'handle'])->name('handle');
Route::post('sample/login', [MyForm::class, 'storeLogin'])->name('storeLogin');
Route::post('sample/logout', [MyForm::class, 'destroySession'])->name('destroySession');
Route::patch('sample/update', [MyForm::class, 'updateData'])->name('updateData');
Route::delete('sample/delete', [MyForm::class, 'delete'])->name('delete');

?>