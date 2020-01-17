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
        //objeto laboratorio donde se hace la consulta a la base de datos accediendo a el nombre y el Id
        $laboratorio = Laboratorio::where('edificio', '=', 'Ligeros 1')->lists('nombre','_id');

        $array = [
          'laboratorios' => $laboratorio,

        ];
        //regresa una vista que se encuentra en la direccion de los parametros
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
        //dentro de la clase se hacen las siguientes evaluaciones donde se marcan como campos requeridos
        $this->validate($request,[
            'nombre' => 'required',
            'fabricante' => 'required',
            'modelo' => 'required',
            'descripcion' => 'required'
        ],[
            //en caso de no cumplir con algun requerimiento
            'nombre.required' => 'Por favor llene el campo "Nombre"',
            'fabricante.required' => 'Por favor llene el campo "Fabricante"',
            'modelo.required' => 'Por favor llene el campo "Modelo"',
            'descripcion.required' => 'por favor agregue una descripción'
        ]);

        Equipo::create([
            //parametros segidos al crear una targeta programable, aqui se pueden ver los valores por defaul y los obtenidos del formulario
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

        //return redirect('/tarjetas-programables/nuevo');
        //regresa la direccion de la lista
        return redirect('/tarjetas-programables/lista');
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
        $tarjeta = Equipo::find($id);

        //se manda llamar el metodo update y manda la informacion obtenida en el formulario para modificarla
        $tarjeta->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
            'laboratorio' => new ObjectID($request->laboratorio),
            'caracteristicas' => [
                $request->fabricante,
                $request->modelo
            ]
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
