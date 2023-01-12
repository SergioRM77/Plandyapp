<?php

use Illuminate\Support\Facades\Route;

Route::get('acercade', function(){
    return view('acercade')->name("acercade");
});
Route::view("/ajustes","ajustes_usuario")->name("ajustes");
Route::view("chat","chat")->name("chat");
Route::view("contactos","contactos")->name("contactos");
Route::view("eventosfinalizados","evento_finalizado")->name("eventosfinalizados");
Route::view("evento","evento")->name("evento");
Route::view("mensajeria","mensajeria")->name("mensajeria");
Route::view("inicio","inicio")->name("inicio");


Route::get('/', function () {
    return view('welcome');
});
