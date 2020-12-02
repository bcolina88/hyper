<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    // nombre de la tabla
    protected $table = 'permisos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rol_id', 'maestro_id', 'agregar', 'editar', 'ver', 'inhabilitar','borrar'
    ];

    /**
     * Cada permiso pertenece a un rol especifico
     */
    public function rol()
    {
        return $this->belongsTo('App\Models\Role','rol_id','id');
    }

    /**
     * Los permisos perteneces a un maestro
     */
    public function maestro()
    {
        return $this->belongsTo('App\Models\Maestro','maestro_id','id');
    }
}
