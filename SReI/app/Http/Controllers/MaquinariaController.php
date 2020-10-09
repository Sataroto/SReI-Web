<?php
/*
    @author obelmonte
    @date 26/05/20
    @modificado obelmonte
    @modified 25/09/20
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
        // Extrayendo datos
        $query = $laboratorio->where('edificio', '=', 'Y');
        $result = $query->documents();
        $documents = $result->rows();

        // Reyenando el arreglo de laboratorios
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
            'fabricante' => $request->fabricante,
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
            'nombre' => 'required|between:3,50',
            'fabricante' => 'required|between:3,100',

        ],[
            'nombre.required' => 'Por favor llene el campo "Nombre"',
            'fabricante.required' => 'Por favor llene el campo "Fabricante" del formulario de herramienta',

        ]);

        // Conección a al API
        $api = config('global.api');

        // Datos tomados del formulario
        $send = [
            'nombre' => $request->nombre,
            'caracteristicas' => [
                'fabricante' => $request->fabricante,
                'modelo' => $request->modelo,
                'serie' => $request->serie
            ],
            'tipo' => 'Herramienta',
            'laboratorio' => $request->laboratorio,
        ];

        // Union de datos del formulario con datos generales para los catalogos
        $send = array_merge($send, config('global.data'));

        // Consulta a la API para crear el equipo
        $request = $api->request('POST', 'catalogos/equipo', [
          'json' => $send
        ]);

        // Resupuesta de la API tras crear el equipo
        $data = json_decode($request->getBody()->getContents());

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $api = config('global.api');

        $send = [
            'id' => $request->_id_maquinaria,
            'nombre' => $request->edit_nombre_maquinaria,
            'laboratorio' => $request->edit_laboratorio_maquinaria,
            'caracteristicas' => [
                'fabricante' => $request->edit_fabricante_maquinaria,
                'modelo' => $request->edit_modelo_maquinaria,
                'serie' => $request->edit_serie_maquinaria,
                'descripcion' => $request->edit_descripcion_maquinaria
            ],
            'estado' => $request->edit_estado_maquinaria+1
        ];

        $request = $api->request('PUT', 'catalogos/equipo', [
            'json' => $send
        ]);

        $data = json_decode($request->getBody()->getContents());
        /*Bitacora([
            'tipo' => 'Edición',
            'movimiento' => 'Maquinaria editada',
            'usuario' => new ObjectID(),
            'coleccion' => 'Equipo'
        ]);*/

        if($data->estatus == 'true') {
            return redirect('/maquinaria/lista');
        } else {
            $errors = explode(',', $data->mensaje);
            return back()->withErrors($errors);
        }
    }

    public function updateHerramienta(Request $request)
    {
        $api = config('global.api');

        $send = [
            'id' => $request->_id_herramienta,
            'nombre' => $request->edit_nombre_herramienta,
            'laboratorio' => $request->edit_laboratorio_herramienta,
            'caracteristicas' => [
                'fabricante' => $request->edit_fabricante_herramienta,
                'modelo' => $request->edit_modelo_herramienta,
                'serie' => $request->edit_serie_maquinaria
            ],
            'estado' => $request->edit_estado_herramienta+1
        ];

        $request = $api->request('PUT', 'catalogos/equipo', [
          'json' => $send,
          'timeout' => 3000,
        ]);

        $data = json_decode($request->getBody()->getContents());
        /*Bitacora([
            'tipo' => 'Edición',
            'movimiento' => 'Maquinaria editada',
            'usuario' => new ObjectID(),
            'coleccion' => 'Equipo'
        ]);*/

        if($data->estatus) {
            return redirect('/maquinaria/lista');
        } else {
            $errors = explode(',', $data->mensaje);
            return back()->withErrors($errors);
        }
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

        $api = config('global.api');

        $response = $api->request('DELETE', 'catalogos/equipo/'.$id);
        $data = json_decode($response->getBody()->getContents());

        /*Bitacora([
            'tipo' => 'Borrado',
            'movimiento' => 'Maquinaria dada de baja',
            'usuario' => new ObjectID(),
            'coleccion' => 'Equipo'
        ]);*/

        if($data->estatus == 'true') {
            return redirect('/maquinaria/lista');
        } else {
            $errors = explode(',', $data->mensaje);
            return back()->withErrors(['Hubo problemas al eliminar, porfabor intente de nuevo']);
        }
    }
}
