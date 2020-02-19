<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Equipo; //USAR LAS COLECCIONES
use App\checklist;
use App\Laboratorio;
use App\Bitacora;
use MongoDB\BSON\ObjectID;

class ArticulosPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // return view('listaPersonal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    public function list() {
        /*
            Busqueda de los objetos de 'Equipo' de tipo 'electronica' dentro de
            la base de datos
        */
        $equipo = Equipo::where('tipo','=','Electronica')->get();


        $array = [
            'equipoElectronica' => $equipo
        ];

        return view('articulosPersonales.listaPersonal', $array);
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
             'foto' => 'required',
             'nombre' => 'required',
             'codigo' =>'required'
         ],
         [
             'foto.required' => 'Por favor cargue una foto en el campo',
             'nombre.required' => 'Por favor llene el campo "Nombre"',
             'codigo.required' => 'Por favor llene el campo "Modelo"',
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

         return redirect('/Personal/nuevo');
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
