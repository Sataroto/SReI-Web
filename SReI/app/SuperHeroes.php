<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class SuperHeroes extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'SuperHeroes';

    protected $fillable = [
        'carcompany', 'model','price'
    ];
}

?>
