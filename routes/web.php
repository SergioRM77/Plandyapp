<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjustesUsuarioController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\MensajeriaController;
use App\Http\Controllers\chatEventoController;
use App\Http\Controllers\chatPrivadoController;
use App\Http\Controllers\chatReporteController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InicioController;

Route::get('/', function () {
    return 'adfgadfg';
});


Route::get("ajustes", AjustesUsuarioController::class)->name('ajustes');
Route::get('contactos',ContactosController::class)->name('contactos');
Route::get('mensajeria',MensajeriaController::class)->name('mensajeria');
Route::get('eventos',InicioController::class)->name('inicio');
Route::get('inicio',InicioController::class)->name('inicio');
Route::get('eventos',[EventoController::class, 'inicio'])->name('evento');
Route::get('eventos/eventosfinalizados',[EventoController::class, 'eventosFianlizados'])->name('eventosfinalizados');
Route::get('mensajeria/chat/{chat}',chatPrivadoController::class)->name('chat');
Route::get('mensajeria/chatevento/{chat}',chatEventoController::class)->name('chatevento');
Route::get('mensajeria/chatreporte/{chat}',chatReporteController::class)->name('chatreporte');
Route::view('acercade', 'acercade')->name('acercade');


/* 
Route::view("chat","chat")->name("chat");
Route::view("contactos","contactos")->name("contactos");
Route::view("eventosfinalizados","evento_finalizado")->name("eventosfinalizados");
Route::view("evento","evento")->name("evento");
Route::view("mensajeria","mensajeria")->name("mensajeria");
Route::view("inicio","inicio")->name("inicio");
 */


?>