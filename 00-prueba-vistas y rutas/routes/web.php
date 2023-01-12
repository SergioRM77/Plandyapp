<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeccionController;

Route::get("/ruta/{seccion}", function($seccion){
    return "Esta es una ruta a: $seccion";
});

// no se debe usar asi, la lógica va en el código no en rutas
Route::get('miruta/{seccion}/{categoria?}', function($seccion, $categoria=null){
    if ($categoria)
        return "esta es mi nueva ruta: sección: $seccion y categoría: $categoria";
    else
        return "esta es mi nueva ruta: $seccion";		
});

Route::get('/HomeController',HomeController::class);
Route::get('/home', [SeccionController::class, 'index']);
Route::get('/crear', [SeccionController::class, 'create']);
Route::get('/mostrar/{seccion}/{subseccion?}', [SeccionController::class, 'show']);


Route::get('/', function () {
    return view('welcome');
})->name("home");

//podemos mostrar datos concretos, string, arrays, objetos...
Route::get('/array', function () {
    return [
        "numero"=> 4,
        "string"=> "hola",

    ];
});


//tambien podemos acceder directamente con Route::view("/URL-a-mostrar". "vista-a-mostrar")
//siempre es bueno dar nombre a las rutas y referenciarlas en las vistas
Route::view("/contacto","contact")->name("contact");
Route::view("/blog","blog")->name("blog");
Route::view("/about","about")->name("about");

/* Ejemplo
    <ul>
        <li><a href="<?= route("blog") ?>">Blog</a></li>
        <li><a href="{{ route("about") }}">A cerca de...</a></li> --> Con blade esta es la forma correcta para evitar inyección de código
    </ul>
 */
