<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\user;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function photo()
    {
        //
        return view('Photo.photoEjemplo');
    }

    public function xxj(Request $request)
    {
      // code...
      //Obtener variable POST e desemcriptarla
        $img = $request['img'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $im = imagecreatefromstring($data);  //convertir text a imagen
        if ($im !== false) {
            imagejpeg($im, '../nombre_imagen.jpg'); //guardar a server
            imagedestroy($im); //liberar memoria
            echo 'Todo salio bien tu imagen ha sido guardada';
        }else {
            echo 'Un error ocurrio al convertir la imagen.';
        }
          return view('Photo.photoEjemplo');
    }

}
