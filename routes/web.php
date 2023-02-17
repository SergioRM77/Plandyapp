<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjustesUsuarioController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\MensajeriaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ChatController;

use App\View\Components\MyForm;
use App\View\Components\TiposEvento\EventoSinPresu;

Route::get('/',[InicioController::class, 'inicio'])->name('inicio')->middleware('auth');
// Route::get('inicio',InicioController::class)->name('inicio')->middleware('auth');
Route::get('inicio',[InicioController::class, 'inicio'])->name('inicio')->middleware('auth');

Route::get('contactos',[ContactosController::class, 'mostrarContactos'])->name('contactos.miscontactos')->middleware('auth');
Route::get('contactosall',[ContactosController::class, 'showAllUsers'])->name('contactos')->middleware('auth');
Route::post('contactos/buscar',[ContactosController::class, 'buscarPorAlias'])->name('contactos.buscar')->middleware('auth');
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

// Route::view('evento/crear',[EventoController::class, 'crearTipoEvento'])->name('evento.crear')->middleware('auth');
Route::get('evento/crear/sin-presupuesto',[EventoController::class, 'newEventoSinPresu'])->name('evento.crear.sin')->middleware('auth');
Route::post('evento/crear/sin-presupuesto',[EventoController::class, 'saveEventoSinPresu'])->name('evento.sinpresu.guardar')->middleware('auth');
Route::post('evento/editar/sin-presupuesto',[EventoController::class, 'editarEventoSinPresu'])->name('evento.sinpresu.editar')->middleware('auth');
Route::post('evento/ver/',[EventoController::class, 'verEvento'])->name('evento.ver')->middleware('auth');

// Route::get('idEvento/{valor}', [EventoController::class, 'valorRoute'])->name('evento.valor')->middleware('auth');



Route::get('mensajeria',MensajeriaController::class)->name('mensajeria')->middleware('auth');
Route::get('mensajeria/chat',[ChatController::class, 'chatPrivado'])->name('chat')->middleware('auth');
Route::get('mensajeria/chatevento/',[ChatController::class, 'chatEvento'])->name('chatevento')->middleware('auth');
Route::get('mensajeria/chatreporte/',[ChatController::class, 'chatReporte'])->name('chatreporte')->middleware('auth');

Route::view('acercade', 'acercade')->name('acercade')->middleware('auth');
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

// Ejemplo formulario con componentes
Route::view('sample', 'sample');
Route::post('sample/registrarse', [MyForm::class, 'handle'])->name('handle');
Route::post('sample/login', [MyForm::class, 'storeLogin'])->name('storeLogin');
Route::post('sample/logout', [MyForm::class, 'destroySession'])->name('destroySession');
Route::patch('sample/update', [MyForm::class, 'updateData'])->name('updateData');
Route::delete('sample/delete', [MyForm::class, 'delete'])->name('delete');

?>