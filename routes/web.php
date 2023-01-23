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
use App\Http\Controllers\HomeController;




Route::get("/componentes", [HomeController::class, 'componentes']);
Route::get("/prueba", [HomeController::class, 'index']);

Route::get('evento/eventofinalizado',[EventoController::class, 'eventoFinalizado'])->name('eventofinalizado');
Route::view('evento/conpresupuesto', 'tiposEvento.eventoConPresu')->name('eventoconpresu');
Route::view('evento/sinpresupuesto', 'tiposEvento.eventoSinPresu')->name('eventosinpresu');
Route::get('/',InicioController::class)->name('inicio');



Route::get('mensajeria',MensajeriaController::class)->name('mensajeria');
Route::get('mensajeria/chat',chatPrivadoController::class)->name('chat');
Route::get('mensajeria/chatevento/',chatEventoController::class)->name('chatevento');
Route::get('mensajeria/chatreporte/',chatReporteController::class)->name('chatreporte');

Route::view('acercade', 'acercade')->name('acercade');
Route::get("ajustes", AjustesUsuarioController::class)->name('ajustes');
Route::get('contactos',ContactosController::class)->name('contactos');
Route::get('inicio',InicioController::class)->name('inicio');

/****esto es lo viejo****/
// Route::get("/componentes", [HomeController::class, 'componentes']);
// Route::get("/prueba", [HomeController::class, 'index']);

// Route::get('evento/eventofinalizado',[EventoController::class, 'eventoFinalizado'])->name('eventofinalizado');
// Route::view('evento/conpresupuesto', 'tiposEvento.eventoConPresu')->name('eventoconpresu');
// Route::view('evento/sinpresupuesto', 'tiposEvento.eventoSinPresu')->name('eventosinpresu');
// Route::get('/',InicioController::class)->name('inicio');



// Route::get('mensajeria',MensajeriaController::class)->name('mensajeria');
// Route::get('mensajeria/chat/{chat}',chatPrivadoController::class)->name('chat');
// Route::get('mensajeria/chatevento/{chat}',chatEventoController::class)->name('chatevento');
// Route::get('mensajeria/chatreporte/{chat}',chatReporteController::class)->name('chatreporte');

// Route::view('acercade', 'acercade')->name('acercade');
// Route::get("ajustes", AjustesUsuarioController::class)->name('ajustes');
// Route::get('contactos',ContactosController::class)->name('contactos');
// Route::get('inicio',InicioController::class)->name('inicio');



?>