<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use App\checklist;

class Equipo extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'Equipo';

    /*
        Genera la relación de 'Equipo' con 'checklist' para llenar el arreglo
        de checklist
    */
    public function checklist() {
        return $this->embedsMany('App\checklist');
    }
}
