<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "objetivos";
     
    protected $fillable = [
        'name','created_at','updated_at','active','fecha_inicial','fecha_fin','valor_inicial','valor_objetivo','proyecto_id','completada'
    ];

    public function proyecto()
    {
        return $this->belongsTo('App\Models\Proyect','proyecto_id','id');
    }


    function palancas() {
        return $this->hasMany("App\Models\Palanca", "objetivo_id", "id");
    }
    
}
