<?php
/*
    Versión 1.5
    Creado al 15/11/2019
    Creado por: GBautista
    Modificado al: 09/09/2020
    Editado por: GBautista
    Copyright SReI
*/
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
        $laboratorios = Laboratorio::where('edificio','=','Ligeros 1')->get();
        $herramienta = Laboratorio::where('tipo','=','Herramiena');
        $labs = [];

        foreach($laboratorios as $l) {
            $lab = [$l->_id => $l->nombre];
            $labs = array_merge($labs, $lab);
        }

        $array = [
            'equipoElectronica' => $equipo,
            'laboratorios' => $labs,
            'herramienta' => $herramienta,
        ];

        return view('equipoElectronica.listaElectronica', $array);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|between:3,50|alpha_num',
            'fabricante' => 'required|between:3,100|alpha_num',
            'modelo' =>'required|between:3,50|alpha_dash',
            'descrip'=>'required|between:10,350',
            'serie' => 'required|between:1,25',
            'procede' =>'required|between:5,50'
        ],
        [
            'nombre.required' => 'Por favor llene el campo "Nombre"',
            'nombre.between' => '"Nombre" esta fuera del rango',
            'nombre.alpha_num' => 'Favor de usar valores alfanumericos',
            'fabricante.required' => 'Por favor llene el campo "Fabricante"',
            'fabricante.between' => '"Fabricante" esta fuera del rango',
            'fabricante.alpha_num' => 'Favor de usar valores alfanumericos',
            'modelo.required' => 'Por favor llene el campo "Modelo"',
            'modelo.between' => '"Modelo" esta fuera del rango',
            'descrip.required' => 'Por favor llene el campo "Descripción"',
            'descrip.between' => '"Descripcion" esta fuera del rango',
            'serie.required' => 'Por favor llene el campo "Serie"',
            'serie.between' => '"Serie" esta fuera del rango',
            'procede.required' => 'Por favor llene el campo "Procedencia"',
            'procede.between' => '"Procedencia" esta fuera del rango',
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
            'nombre' => 'required|between:3,50|alpha_num',
            'fabricante' => 'required|between:3,100|alpha_num',
            'modelo' =>'required|between:3,50|alpha_dash',
        ],[
            'nombre.required' => 'Por favor llene el campo "Nombre" del formulario de herramienta',
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
         $laboratorios = Laboratorio::where('edificio','=','Ligeros 1')->lists('nombre','_id');
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
        $this->validate($request, [
            'nombre' => 'required|between:3,50|alpha_num',
            'fabricante' => 'required|between:3,100|alpha_num',
            'modelo' =>'required|between:3,50|alpha_dash',
        ],
        [
            'nombre.required' => 'Por favor llene el campo "Nombre"',
            'nombre.between' => '"Nombre" esta fuera del rango',
            'nombre.alpha_num' => 'Favor de usar valores alfanumericos',
            'fabricante.required' => 'Por favor llene el campo "Fabricante"',
            'fabricante.between' => '"Fabricante" esta fuera del rango',
            'fabricante.alpha_num' => 'Favor de usar valores alfanumericos',
            'modelo.required' => 'Por favor llene el campo "Modelo"',
            'modelo.between' => '"Modelo" esta fuera del rango',
        ]
    );
        $equipo = Equipo::find($id);
        $equipo->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
            'caracteristicas' => [
                $request->fabricante,
                $request->modelo,
  //            $request->descripcion,
  //              $request->numeroSerie,
  //              $request->procedencia
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
