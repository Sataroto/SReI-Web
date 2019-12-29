<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class checklist extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'checklist';

    /*
        Al no existir una colección de checklist dentro de la base de datos
        haemos uso de una variable 'fillable' para poder hacer uso de los
        campos definidos en l arreglo
    */
    protected $fillable = [
        'nomenclatura',
        'estado'
    ];
}
