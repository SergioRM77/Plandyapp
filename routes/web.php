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






Route::get('evento/eventofinalizado',[EventoController::class, 'eventoFinalizado'])->name('eventofinalizado')->middleware('auth');
Route::view('evento/conpresupuesto', 'tiposEvento.eventoConPresu')->name('eventoconpresu')->middleware('auth');
Route::view('evento/sinpresupuesto', 'tiposEvento.eventoSinPresu')->name('eventosinpresu')->middleware('auth');
Route::get('/',InicioController::class)->name('inicio')->middleware('auth');



Route::get('mensajeria',MensajeriaController::class)->name('mensajeria')->middleware('auth');
Route::get('mensajeria/chat',[ChatController::class, 'chatPrivado'])->name('chat')->middleware('auth');
Route::get('mensajeria/chatevento/',[ChatController::class, 'chatEvento'])->name('chatevento')->middleware('auth');
Route::get('mensajeria/chatreporte/',[ChatController::class, 'chatReporte'])->name('chatreporte')->middleware('auth');

Route::view('acercade', 'acercade')->name('acercade')->middleware('guest');
Route::get("ajustes", [AjustesUsuarioController::class, 'index'])->name('ajustes')->middleware('auth');
Route::patch("ajustes", [AjustesUsuarioController::class, 'update'])->name('updateUser')->middleware('auth');
Route::get('contactos',ContactosController::class)->name('contactos')->middleware('auth');
Route::get('inicio',InicioController::class)->name('inicio')->middleware('auth');
Route::post('inicio',InicioController::class)->name('inicio')->middleware('auth');


//Route::get('login',[LoginRegisterController::class, 'login'])->name('login')->middleware('guest');
Route::view('login','auth.login')->name('login');
Route::post('login',[LoginRegisterController::class, 'storeLogin'])->middleware('guest');

Route::view('registrarse','auth.registrarse')->name('registrarse');
Route::post('registrarse',[LoginRegisterController::class, 'store']);
Route::post('logout',[LoginRegisterController::class, 'destroySession'])->name('logout');
Route::get('logout',[LoginRegisterController::class, 'destroySession'])->name('logout');


Route::get('/setSession', [SessionController::class, 'setSessionData'])->name('setSessionData')->middleware('auth');
Route::get('/getAccessSession', [SessionController::class, 'getAccessSession'])->name('getAccessSession')->middleware('auth');
Route::get('/deleteSessionData', [SessionController::class, 'deleteSetSessionData'])->name('deleteSetSessionData')->middleware('auth');





?>