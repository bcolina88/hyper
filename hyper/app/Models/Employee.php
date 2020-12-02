<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    
    protected $table = "employees";

    protected $fillable = [
        'rut', 'nombre','apellido','role_id', 'telefono','sueldo_mensual','sueldo_diario','created_at','updated_at','fecha','active'

    ];

    public function role()
    {

        return $this->belongsTo('App\Models\Role','role_id','id');
    }
    
}
