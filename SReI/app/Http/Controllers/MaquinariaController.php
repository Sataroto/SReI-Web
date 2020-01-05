<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Equipo;
use App\checklist;
use \App\Laboratorio;
use MongoDB\BSON\ObjectID;

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
        /*
            Busqueda de los objetos de 'Equipo' de tipo 'maquinaria' dentro de
            la base de datos
        */
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

        $laboratorios = Laboratorio::where('edificio', '=', 'Pesados 1')->lists('nombre','_id');

        $array = [
            'laboratorios' => $laboratorios,
        ];

        return view('registroMaquina', $array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Creación de objeto 'Equipo' dentro de la base de datos
        $maquina = Equipo::create([
            'tipo' => "maquinaria",
            'nombre' => $request->nombre,

            /*
                Estados :
                    0 -> Dañado
                    1 -> en buen estado
                    2 -> en mantenimiento
            */
            'estado' => 1.0,
            'disponible' => true,
            'propietario' => new ObjectId("5dd9f07fa37ae152693bc5ea"),
            'laboratorio' => new ObjectId($request->laboratorio),
            'mantenimientos' => [],
            'caracteristicas' => [
                $request->fabricante,
                $request->modelo
            ],
            'observaciones' => "",
            'checklist' => [],
        ]);

        // Recorrer el arreglo de checklist tomado del forulario
        foreach ($request->checklist as $ch) {

            /*
            El objeto 'checklist' tiene un modelo pero no una colección
            dentro de la base de datos, siendo un objeto embebido o
            subcolección del objeto 'Equipo'
            */
            // Creació de un objeto 'checklist'
            $check = $maquina->checklist()->create([
                'nomenclatura' => $ch,
                'estado' => 1.0,
            ]);
            /*$check = new checklist();

            // Vease el modelo de checklist para asigar los siguientes atributos
            $check->nomenclatura = $ch;
            $check->estado = 1.0;

            /*
                Guardado del objeto 'checklist dentro de su arreglo en el objeto
                'Equipo'
            */
            //$check = $maquina->checklist()->save($check);
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

        Equipo::find($id)->delete();

        return redirect('/listaMaquina');
    }
}
