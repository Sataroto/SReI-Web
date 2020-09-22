<?php
/*
    @author obelmonte
    @date 26/05/20
    @modificado obelmonte
    @modified 10/09/20
    @copyright SReI
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
        $maquinaria = [];
        $herramientas = [];
        $laboratorios = [];

        $firestore = config('global.firestore');
        $equipo = $firestore->collection('EQP');
        $laboratorio = $firestore->collection('LAB');

        /* -- Equipo --*/
        // extrayendo datos
        $query = $equipo->where('tipo', '=', 'Maquinaria');
        $result = $query->documents();
        $documents = $result->rows();

        // reyenando el arreglo de maquinaria
        foreach($documents as $doc) {
            $data = $doc->data();

            $obj = new Equipo($data);
            $obj->_id = $data['id'];
            $obj->estado = $data['estado'] - 1;

            $maquina = [$obj];
            $maquinaria = array_merge($maquinaria, $maquina);
        }
        /* -- Fin de Equipo--*/

        /* -- Herramientas -- */
        // extrayendo datos
        $query = $equipo->where('tipo', '=', 'Herramienta');
        $result = $query->documents();
        $documents = $result->rows();

        // reyenando arreglo de herramientas
        foreach($documents as $doc) {
            $data = $doc->data();

            $obj = new Equipo($data);
            $obj->_id = $data['id'];
            $obj->estado = $data['estado'] - 1;

            $herr = [$obj];
            $herramientas = array_merge($herramientas, $herr);
        }
        /* -- Fin de Herramientas -- */

        /* -- Laboratorios -- */
        // extrayendo datos
        $query = $laboratorio->where('edificio', '=', 'Y');
        $result = $query->documents();
        $documents = $result->rows();

        // reyenando el arreglo de laboratorios
        foreach($documents as $doc) {
            $data = $doc->data();

            $labs = [$data['id'] => $data['nombre']];
            $laboratorios = array_merge($laboratorios, $labs);
        }
        /* -- Fin de Laboratorios -- */

        $array = [
            'maquina' => $maquinaria,
            'laboratorios' => $laboratorios,
            'herramienta' => $herramientas,
            'api_errors' => 0
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
              'serie' => 'required',
          ],
          [
              'nombre.required' => 'Por favor llene el campo "Nombre" del formulario de maquinaria',
              'fabricante.required' => 'Por favor llene el campo "Fabricante" del formulario de maquinaria',
              'modelo.required' => 'Por favor llene el campo "Modelo" del formulario de maquinaria',
              'serie.required' => 'Por favor llene el campo "Numero de serie" del formulario de maquinaria',
        ]);

        // Conección a al API
        $api = config('global.api');

        // Datos tomados del formulario
        $send = [
          'nombre' => $request->nombre,
          'caracteristicas' => [
            'fabricanta' => $request->fabricante,
            'modelo' => $request->modelo,
            'serie' => $request->serie,
            'descripcion' => $request->descripcion
          ],
          'tipo' => 'Maquinaria',
          'laboratorio' => $request->laboratorio,
        ];

        // Union de datos del formulario con datos generales para los catalogos
        $send = array_merge($send, config('global.data'));

        // Consulta a la API para crear el equipo
        $query = $api->request('POST', 'catalogos/equipo', [
          'json' => $send
        ]);

        // Resupuesta de la API tras crear el equipo
        $data = json_decode($query->getBody()->getContents());

        /*Bitacora([
            'tipo' => 'Borrado',
            'movimiento' => 'Maquinaria dada de baja',
            'usuario' => new ObjectID(),
            'coleccion' => 'Equipo'
        ]);*/

        /*
            Retorno segun la respuesta de la api
                * Si la respuesta es 'true' redirige con normalidad
                * Si la respuesta no es 'true' separa los errores y los manda de regreso
        */
        if($data->estatus == 'true') {
            return redirect('/maquinaria/lista');
        } else {
            $errors = explode(',', $data->mensaje);
            return back()->withErrors($errors);
        }

    }

    public function nuevaHerramienta(Request $request) {
        $this->validate($request,[
            'nombre' => 'required|between:3,50|alpha_num',
            'fabricante' => 'required|between:3,100|alpha_num',
            'modelo' =>'required|between:3,50|alpha_dash',
            'serie' => 'required|between:3,25|alpha_dash',
        ],[
            'nombre.required' => 'Por favor llene el campo "Nombre"',
            'fabricante.required' => 'Por favor llene el campo "Fabricante" del formulario de herramienta',
            'modelo.required' => 'Por favor llene el campo "Modelo" del formulario de herramienta',
            'serie.required' => 'Por favor llene el campo "Numero de serie" del formulario de herramienta',
        ]);

        for($i=0;$i<$request->cantidad;$i++) {
        $herramienta = Equipo::create([
            'tipo' => "Herramienta",
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
            ],
        ]);
        }

        return redirect('maquinaria/lista');
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
