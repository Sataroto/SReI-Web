<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{

    protected $fillable = [
        '_id',
        'edificio',
        'nombre',
    ];
}
