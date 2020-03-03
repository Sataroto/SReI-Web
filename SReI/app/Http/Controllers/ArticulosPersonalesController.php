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
         //objeto laboratorio donde se hace la consulta a la base de datos accediendo a el nombre y el Id
         $laboratorio = Laboratorio::where('edificio', '=', 'Ligeros 1')->lists('nombre','_id');

         $array = [
           'laboratorios' => $laboratorio,

         ];
         //regresa una vista que se encuentra en la direccion de los parametros
         return view('articulosPersonales.registroPersonal', $array);
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
           'nombre' => 'required',
           'fabricante' => 'required',
           'modelo' =>'required',
           'serie' => 'required',
         ],
         [
           'nombre.required' => 'Por favor llene el campo "Nombre" del formulario de maquinaria',
           'fabricante.required' => 'Por favor llene el campo "Fabricante" del formulario de maquinaria',
           'modelo.required' => 'Por favor llene el campo "Modelo" del formulario de maquinaria',
           'serie.required' => 'Por favor llene el campo "Numero de serie" del formulario de maquinaria',
         ]
     );

     for($i=0;$i<$request->cantidad;$i++) {
         // Creación de objeto 'Equipo' dentro de la base de datos
         $personal = Equipo::create([
             'tipo' => "Maquinaria",
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
             'caracteristicas' => [],
 //            'checklist' => [],
         ]);

         if(strlen($request->descripcion) == 0) {
            $personal->update([
                 'caracteristicas' => [
                     $request->fabricante,
                     $request->modelo,
                     $request->serie
                 ],
             ]);
         } else {
             $personal->update([
                 'caracteristicas' => [
                     $request->fabricante,
                     $request->modelo,
                     $request->serie,
                     $request->descripcion
                 ],
             ]);
         }
         // Recorrer el arreglo de checklist tomado del forulario
         foreach ($request->checklist as $ch) {

             /*
             El objeto 'checklist' tiene un modelo pero no una colección
             dentro de la base de datos, siendo un objeto embebido o
             subcolección del objeto 'Equipo'
             */
             // Creació de un objeto 'checklist'
             $check = $personal->checklist()->create([
                 'nomenclatura' => $ch,
                 'estado' => 1.0,
             ]);
         }
     }

       return redirect('/personal/lista');
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
        //se crea un objeto lista para hacer una consulta a la base de datos
        $personal = Equipo::find($id);

        //se manda llamar el metodo update y manda la informacion obtenida en el formulario para modificarla
        $personal->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
            'caracteristicas' => [
                $request->fabricante,
                $request->modelo
            ],
            'laboratorio' => new ObjectId($request->laboratorio)

        ]);
        //ejecuta el metodo response donde accede al Json y manda un mensaje de exito
        return response()->json(['success' => 'Got Simple Ajax Request']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

  // public function list() {
      /*
          Busqueda de los objetos de 'Equipo' de tipo 'maquinaria' dentro de
          la base de datos
      */
//     $personal = Equipo::where('tipo','=','Articulo Personal')->get();
    // $laboratorios = Laboratorio::where('edificio', '=', 'Ligeros 1')->lists('nombre','_id');

    //  $array = [
      // 'tarjeta' => $tarjetas,
        //  'laboratorios' => $laboratorios
    //  ];

  //  return view('personal/lista', $array);
//    }
}
