<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mantenimientoController extends Controller
{
    
    public function show()
    {
        return view('Mantenimientos.Calendario');
    }
}
