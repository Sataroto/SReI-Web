<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\checklist;

class Equipo extends Eloquent
{

    protected $fillable = [
        '_id',
        'tipo',
        'nombre',
        'estado',
        'disponible',
        'propietario',
        'laboratorio',
        'caracteristicas',
        'checklist'
    ];

    public function lab() {
        //return $this->hasOne('\App\Laboratorio', '_id', 'laboratorio');
        $firestore = config('global.firestore');
        $collection = $firestore->collection('LAB');
        $document = $collection->document($this->laboratorio);
        $snapshot = $document->snapshot();
        $data = $snapshot->data();

        $laboratorio = new \App\Laboratorio($data);
        return $laboratorio;
    }

    /*
        Genera la relación de 'Equipo' con 'checklist' para llenar el arreglo
        de checklist
    */
    public function checklist() {
        return $this->embedsMany('App\checklist');
    }

    public function caracteristicas() {
        return $this->embedsOne('Caracteristicas');
    }
}

class Carecteristicas extends Eloquent
{
    protected $fillable = [
        'fabricante',
        'modelo',
        'serie',
        'descripcion'
    ];
}
