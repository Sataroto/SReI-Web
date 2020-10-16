<?php
/*
Versión 1.0
Creado al 14/01/2020
Modificao al 14/10/2020
Editado por: lmendez
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

class TarjetaController extends Controller
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
            Busqueda de los objetos de 'Equipo' de tipo 'Tarjetas Programables' dentro de
            la base de datos
        */
        $tarjetaP = [];
        $laboratorios = [];

        $firestore = config('global.firestore');
        $equipo = $firestore->collection('EQP');
        $laboratorio = $firestore->collection('LAB');

        /* -- Tarjeta Programable--*/
        // extrayendo datos
        $query = $equipo->where('tipo', '=', 'Tarjetas Programables');
        $result = $query->documents();
        $documents = $result->rows();

        // reyenando el arreglo de Tarjeta Programable
        foreach($documents as $doc) {
            $data = $doc->data();

            $obj = new Equipo($data);
            $obj->_id = $data['id'];
            $obj->estado = $data['estado'] - 1;

            $tarjeta = [$obj];
            $tarjetaP = array_merge($tarjetaP, $tarjeta);
        }
        /* -- Fin de Tarjeta Programable--*/

        /* -- Laboratorios -- */
        // Extrayendo datos
        $query = $laboratorio->where('edificio', '=', 'X'); 
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
            'tarjeta' => $tarjetaP,
            'laboratorios' => $laboratorios,
            'api_errors' => 0
        ];

        return view('tarjetasProgramables.listaTarjetas', $array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //nueva tarjeta programable
        $this->validate($request, [
              'nombre' => 'required',
              'fabricante' => 'required',
              'modelo' =>'required',
              'serie' => 'required',
          ],
          [
              'nombre.required' => 'Por favor llene el campo "Nombre" del formulario de Tarjeta programable',
              'fabricante.required' => 'Por favor llene el campo "Fabricante" del formulario de Tarjeta programable',
              'modelo.required' => 'Por favor llene el campo "Modelo" del formulario de Tarjeta programable',
              'serie.required' => 'Por favor llene el campo "Numero de serie" del formulario de Tarjeta programable',
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
          'tipo' => 'Tarjetas Programables',
          'laboratorio' => $request->laboratorio,
        ];

        // Union de datos del formulario con datos generales para los catalogos
        $send = array_merge($send, config('global.data'));

        // Consulta a la API para crear la tarjeta programable
        $query = $api->request('POST', 'catalogos/equipo', [
          'json' => $send
        ]);

        // Resupuesta de la API tras crear la tarjeta programable
        $data = json_decode($query->getBody()->getContents());

        /*Bitacora([
            'tipo' => 'Borrado',
            'movimiento' => 'Tarjeta dada de baja',
            'usuario' => new ObjectID(),
            'coleccion' => 'Equipo'
        ]);*/

        /*
            Retorno segun la respuesta de la api
                * Si la respuesta es 'true' redirige con normalidad
                * Si la respuesta no es 'true' separa los errores y los manda de regreso
        */
        if($data->estatus == 'true') {
            return redirect('/tarjetasProgramables/listaTarjetas');
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
            'id' => $request->_id_tarjeta,
            'nombre' => $request->edit_nombre_tarjeta,
            'laboratorio' => $request->edit_laboratorio_tarjeta,
            'caracteristicas' => [
                'fabricante' => $request->edit_fabricante_tarjeta,
                'modelo' => $request->edit_modelo_tarjeta,
                'serie' => $request->edit_serie_tarjeta,
                'descripcion' => $request->edit_descripcion_tarjeta
            ],
            'estado' => $request->edit_estado_tarjeta+1
        ];

        $request = $api->request('PUT', 'catalogos/equipo', [
            'json' => $send
        ]);

        $data = json_decode($request->getBody()->getContents());
        /*Bitacora([
            'tipo' => 'Edición',
            'movimiento' => 'Tarjeta editada',
            'usuario' => new ObjectID(),
            'coleccion' => 'Equipo'
        ]);*/

        if($data->estatus == 'true') {
            return redirect('/tarjetasProgramables/listaTarjetas');
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
        $api = config('global.api');

        $response = $api->request('DELETE', 'catalogos/equipo/'.$id);
        $data = json_decode($response->getBody()->getContents());

        /*Bitacora([
            'tipo' => 'Borrado',
            'movimiento' => 'Tarjeta dada de baja',
            'usuario' => new ObjectID(),
            'coleccion' => 'Equipo'
        ]);*/

        if($data->estatus == 'true') {
            return redirect('/tarjetasProgramables/listaTarjetas');
        } else {
            $errors = explode(',', $data->mensaje);
            return back()->withErrors(['Hubo problemas al eliminar, por favor intente de nuevo']);
        }
    }
}
