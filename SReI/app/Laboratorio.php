<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Eloquent
{

    protected $fillable = [
        '_id',
        'edificio',
        'nombre',
    ];
}
