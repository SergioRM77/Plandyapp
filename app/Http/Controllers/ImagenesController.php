<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
/**
 * Al subir a producción se debe hacer un php artisan storage:link
 * para crear un acceso de la carpeta public a storage(donde se guardan los archivos, fotos...)
 * en el formulario es necesario enctype="multipart/form-data"
 */

class ImagenesController extends Controller
{
    public function subirImagen(){
        return view("formImage");
    }
    public static function guardarImagen(Request $request){
        $request->validate([
            'foto' => 'nullable|image|max:2048'
        ]);
        if ($request->foto == null) return null;
        $nuevoNombre = ImagenesController::renombrarImagen($request);
        $rutaStorage = ImagenesController::guardarEnStorage($nuevoNombre);
        Image::make($request->file('foto'))
            ->resize('500', null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($rutaStorage);
        
        return ImagenesController::definirRutaBD($nuevoNombre);
    }

    public static function definirRutaBD($nombreImagen){
        return "storage\imagenes\\" . $nombreImagen;
    }

    public static function guardarEnStorage($nombreImagen){
        return storage_path() . "\app\public\imagenes\\" . $nombreImagen;
    }


    public static function renombrarImagen($imagen){
        $nombreCompleto = $imagen->file('foto')->getClientOriginalName();
        $partesNombre = explode('.' , $nombreCompleto);
        $nombre = substr($partesNombre[0], 0, 7);
        $extension = $partesNombre[1];
        return  date('Y_md_His') . "_" .  session('id') . "_" . $nombre . "." . $extension;
    }

    public static function mostrarImagen($rutaImagen){
        $img = Image::make($rutaImagen)->resize(300);
        return $img->response();
    }

}
