<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyect extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "proyects";
     
    protected $fillable = [
        'name','created_at','updated_at','active','tipo_proy'
    ];

    public function users() {
        return $this->hasMany("App\Models\UserProyect", "proyect_id", "id");
    }

    function objetivos() {
        return $this->hasMany("App\Models\Objetivo", "proyecto_id", "id");
    }
    
}
