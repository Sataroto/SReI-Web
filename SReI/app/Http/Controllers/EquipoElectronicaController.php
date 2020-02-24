<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Equipo;
use App\checklist;
use App\Laboratorio;
use App\Bitacora;
use MongoDB\BSON\ObjectID;

class EquipoElectronicaController extends Controller
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
    public function list() {
        /*
            Busqueda de los objetos de 'Equipo' de tipo 'electronica' dentro de
            la base de datos
        */
        $equipo = Equipo::where('tipo','=','Electronica')->get();
        $laboratorios = Laboratorio::where('edificio', '=', 'Ligeros 1')->lists('nombre','_id');
        $herramienta = Laboratorio::where('tipo', '=', 'Herramiena');

        $array = [
            'equipoElectronica' => $equipo,
            'laboratorios' => $laboratorios,
            'herramienta' => $herramienta,
        ];

        return view('equipoElectronica.listaElectronica', $array);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required',
            'fabricante' => 'required',
            'modelo' =>'required',
            'descrip'=>'required',
            'serie' => 'required',
            'procede' =>'required'
        ],
        [
            'nombre.required' => 'Por favor llene el campo "Nombre"',
            'fabricante.required' => 'Por favor llene el campo "Fabricante"',
            'modelo.required' => 'Por favor llene el campo "Modelo"',
            'descrip.required' => 'Por favor llene el campo "Descripción"',
            'serie.required' => 'Por favor llene el campo "Modelo"',
            'procede.required' => 'Por favor llene el campo "Procedencia"',
        ]
    );

        // Creación de objeto 'Equipo' dentro de la base de datos
        Equipo::create([
            'tipo' => "Electronica",
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
            'caracteristicas' => [
                $request->fabricante,
                $request->modelo,
                $request->descrip,
                $request->serie,
                $request->procede

            ],
        ]);

        //return redirect('/equipoElectronica/nuevo');
        return redirect('/equipoElectronica/lista');
    }

    public function nuevaHerramienta(Request $request) {
        $this->validate($request,[
            'nombre' => 'required',
            'laboratorio' => 'required',
            'fabricante' => 'required',
            'modelo' => 'required'
        ],[
            'nombre.required' => 'Por favor llene el campo "Nombre" del formulario de herramienta',
            'laboratorio.required' => 'Por favor llene el campo "Laboratorio" de formulario de herramienta',
            'fabricante' => 'Por favor llene el campo "fabricante" de formulario de herramienta',
            'modelo' => 'Por favor llene el campo "Modelo" de formulario de herramienta'
        ]);

        $herramienta = Equippo::create([
            'tipo' => "Electronica",
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
            'caracteristicas' => [
                $request->fabricante,
                $request->modelo,
                $request->serie,
                $request->descripcion,
            ],
        ]);

        return redirect('/equipoElectronica/lista');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
         //

         $laboratorios = Laboratorio::where('edificio', '=', 'Ligeros 1')->lists('nombre','_id');

         $array = [
             'laboratorios' => $laboratorios,
         ];

         return view('equipoElectronica.registroEquipoElectronica', $array);
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
        $equipo = Equipo::find($id);


        $equipo->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
            'caracteristicas' => [
                $request->fabricante,
                $request->modelo,
                $request->descripcion,
                $request->numeroSerie,
                $request->procedencia
            ],
            'laboratorio' => new ObjectId($request->laboratorio)

        ]);

        /*Bitacora([
            'tipo' => 'Edición',
            'movimiento' => 'Maquinaria editada',
            'usuario' => new ObjectID(),
            'coleccion' => 'Equipo'
        ]);*/

        return response()->json(['success'=>'Got Simple Ajax Request.']);
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
