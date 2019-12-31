<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Laboratorio extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'Laboratorio';

    protected $fillable = [
        'edificio',
        'nombre',
        'activo',
    ];
}
