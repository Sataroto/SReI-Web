<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Equipo;
use App\Laboratorio;
use App\Bitacora;

use MongoDB\BSON\ObjectID;

class TarjetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $laboratorio = Laboratorio::where('edificio', '=', 'Ligeros 1')->lists('nombre','_id');

        $array = [
          'laboratorios' => $laboratorio,

        ];

        return view('tarjetasProgramables.registroTarjetas', $array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Equipo::create([
          'tipo' => 'Tarjeta Programable',
          'nombre' => $request->nombre,
          'estado' => 1,
          'disponible' => true,
          'propietario' => new ObjectId("5dd9f07fa37ae152693bc5ea"),
          'laboratorio' => new ObjectId($request->laboratorio),
          'caracteristicas' => [
            $request->fabricante,
            $request->modelo
          ],
          'descripcion' => $request->descripcion
        ]);

        return redirect('/tarjetas-programables/nuevo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function list() {
        /*
            Busqueda de los objetos de 'Equipo' de tipo 'maquinaria' dentro de
            la base de datos
        */
        $tarjetas = Equipo::where('tipo','=','Tarjeta Programable')->get();
        $laboratorios = Laboratorio::where('edificio', '=', 'Ligeros 1')->lists('nombre','_id');

        $array = [
            'tarjeta' => $tarjetas,
            'laboratorios' => $laboratorios
        ];

        return view('tarjetasProgramables.listaTarjetas', $array);
    }
}
