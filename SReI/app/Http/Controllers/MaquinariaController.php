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
        $laboratorios = Laboratorio::where('edificio', '=', 'Pesados 1')->lists('nombre','_id');

        $array = [
            'maquina' => $maquinaria,
            'laboratorios' => $laboratorios
        ];

        return view('maquinaria.lista', $array);
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

        return view('maquinaria.registro', $array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required',
            'fabricante' => 'required',
            'modelo' =>'required',
        ],
        [
            'nombre.required' => 'Por favor llene el campo "Nombre"',
            'fabricante.required' => 'Por favor llene el campo "Fabricante"',
            'modelo.required' => 'Por favor llene el campo "Modelo"',
        ]
    );

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
            'caracteristicas' => [
                $request->fabricante,
                $request->modelo
            ],
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
        }

        /*Bitacora([
            'tipo' => 'Borrado',
            'movimiento' => 'Maquinaria dada de baja',
            'usuario' => new ObjectID(),
            'coleccion' => 'Equipo'
        ]);*/

        //return redirect('/maquinaria/nuevo');
        return redirect('/maquinaria/lista');
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
        return response()->json(['success'=>'Got Simple Ajax Request.']);
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

        $maquina = Equipo::find($id);


        $maquina->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
            'caracteristicas' => [
                $request->fabricante,
                $request->modelo
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

        Equipo::find($id)->delete();

        /*Bitacora([
            'tipo' => 'Borrado',
            'movimiento' => 'Maquinaria dada de baja',
            'usuario' => new ObjectID(),
            'coleccion' => 'Equipo'
        ]);*/

        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }
}
