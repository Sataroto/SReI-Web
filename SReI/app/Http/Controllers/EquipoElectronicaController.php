<?php
/*
    Versión 1.6
    Creado al 15/01/2020
    Creado por: GBautista
    Modificado al: 27/09/2020
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
        //arreglos necesarios
        $equipos=[];
        $labs=[];
        //conexion con base de datos 
        $firetore = config('global.firestore');
        $lab = $firetore->collection('LAB');
        //datos especificos de laboratorio electronica
        $query = $lab->where('edificio','=','X');
        $document = $query->documents()->rows();
        
        foreach($document as $doc){
            $data = $doc->data();

            $aux = [$data['id'] => $data['nombre']];
            $labs = array_merge($labs,$aux);
        }

        //Conexion a API
        $api = config('global.api');
        // Consulta a la API para crear el equipo
        $query = $api->request('GET', 'catalogos/equipo/tipo/Electronica');
  
        // Resupuesta de la API tras crear el equipo
        $data = json_decode($query->getBody()->getContents());

        if($data->estatus == 'true') {
            foreach($data->eqps as $eqp){
                $obj = new Equipo((array)$eqp);
                $obj->_id = $eqp->id;
                $obj->estado = $eqp->estado - 1;

                $equipo = [$obj];
                $equipos = array_merge($equipos, $equipo);
            }
            //envio de info
            $array = [
                'equipoElectronica' => $equipos,
                'laboratorios' => $labs,
                'api_errors' => 1
            ];
        
            return view('equipoElectronica.listaElectronica', $array);
    
        } else {
            $errors = explode(',', $data->mensaje);
            return back()->withErrors($errors);
        }
    }
    

    public function store(Request $request)
    {
        $this->validate($request, [
                'nombre' => 'required|between:3,50',
                'fabricante' => 'required|between:3,100',
                'modelo' =>'required|between:3,50',
                'descrip'=>'required|between:10,350',
                'serie' => 'required|between:1,25',
            ],
            [
                'nombre.required' => 'Por favor llene el campo "Nombre"',
                'nombre.between' => '"Nombre" esta fuera del rango',
                'fabricante.required' => 'Por favor llene el campo "Fabricante"',
                'fabricante.between' => '"Fabricante" esta fuera del rango',
                'modelo.required' => 'Por favor llene el campo "Modelo"',
                'modelo.between' => '"Modelo" esta fuera del rango',
                'descrip.required' => 'Por favor llene el campo "Descripción"',
                'descrip.between' => '"Descripcion" esta fuera del rango',
                'serie.required' => 'Por favor llene el campo "Serie"',
                'serie.between' => '"Serie" esta fuera del rango',
            ]
        );

        //Conexion a API

        $api = config('global.api');

        // Datos tomados del formulario
        $send = [
            'nombre' => $request->nombre,
            'caracteristicas' => [
              'fabricante' => $request->fabricante,
              'modelo' => $request->modelo,
              'serie' => $request->serie,
              'descripcion' => $request->descrip
            ],
            'tipo' => 'Electronica',
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

        if($data->estatus == 'true') {
            return redirect('/equipoElectronica/lista');
        } else {
            $errors = explode(',', $data->mensaje);
            return back()->withErrors($errors);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
        $labs=[];
        //conexion con base de datos 
        $firetore = config('global.firestore');
        $lab = $firetore->collection('LAB');
        //datos especificos de laboratorio electronica
        $query = $lab->where('edificio','=','X');
        $document = $query->documents()->rows();
        
        foreach($document as $doc){
            $data = $doc->data();

            $aux = [$data['id'] => $data['nombre']];
            $labs = array_merge($labs,$aux);
        }

         $array = [
             'laboratorios' => $labs,
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
    public function update(Request $request)
    {
        $api = config('global.api');
        $send = [
            'id' => $request->_id_electronica,
            'nombre' => $request->edit_nombre_electronica,
            'laboratorio' => $request->edit_laboratorio_electronica,
            'caracteristicas' => [
                'fabricante' => $request->edit_fabricante_electronica,
                'modelo' => $request->edit_modelo_electronica,
                'serie' => $request->edit_serie_electronica,
                'descripcion' => $request->edit_descripcion_electronica
            ],
            'estado' => $request->edit_estado_electronica+1
        ];

        $request = $api->request('PUT', 'catalogos/equipo', [
            'json' => $send
        ]);
        $data = json_decode($request->getBody()->getContents());
        
        if($data->estatus == 'true') {
            return redirect('/equipoElectronica/lista');
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
        if($data->estatus == 'true') {
            return redirect('/equipoElectronica/lista');
        } else {
            $errors = explode(',', $data->mensaje);
            return back()->withErrors(['Hubo problemas al eliminar, porfavor intente de nuevo']);
        }
    }
}
