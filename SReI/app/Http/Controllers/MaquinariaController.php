<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Equipo;
use App\checklist;

class MaquinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function list() {
        $maquinaria = Equipo::where('tipo','=','maquinaria')->get();

        $array = [
            'maquina' => $maquinaria
        ];

        return view('listaMaquinaria', $array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('registroMaquina');
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
        $maquina = new Equipo(); // Creación de objeto 'Equipo'

        /*Inicialización de los atributos*/
        $maquina->tipo = "maquinaria";
        $maquina->nombre = $request->nombre;
        $maquina->estado = 0.0;
        $maquina->Propietario = 'ObjectId("5dd9f07fa37ae152693bc5ea")';
        $maquina->mantenimientos = [];
        $maquina->mantenimiento = null;
        $maquina->caracteristicas = [
            $request->fabricante,
            $request->modelo
        ];
        $maquina->descripcion = "";
        $maquina->observaciones = "";
        $maquinaria->checklist = [];

        $maquina->save(); // Guardado del objeto 'Equipo' dentro de la base de datos

        // Recorrer el arreglo de checklist tomado del forulario
        foreach ($request->checklist as $ch) {
            $check = new checklist(); // Creació de un objeto 'checklist'
            /*
                El objeto 'checklist' tiene un modelo pero no una colección
                dentro de la base de datos, siendo un objeto embebido o
                subcolección del objeto 'Equipo'
            */

            // Vease el modelo de checklist para asigar los siguientes atributos
            $check->nomenclatura = $ch;
            $check->estado = 1.0;

            /*
                Guardado del objeto 'checklist dentro de su arreglo en el objeto
                'Equipo'
            */
            $check = $maquina->checklist()->save($check);
        }

        return redirect('/registroMaquina');
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
}
