<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    // nombre de la tabla
    protected $table = 'maestros';

    /**
     * Un maestro puede ser una subseccion, por lo que puede tener un maestro padre
     */
    public function padre()
    {
        return $this->belongsTo('App\Models\Maestro', 'padre_id', 'id');
    }
}
