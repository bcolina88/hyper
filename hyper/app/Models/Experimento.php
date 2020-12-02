<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experimento extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "experimentos";
     
    protected $fillable = [
        'name','fecha_inicial','fecha_fin','tiempo','presupuesto','completada','created_at','updated_at',
        'active','palanca_id','alcance'
    ];


    function palanca() {
        return $this->belongsTo("App\Models\Palanca", "palanca_id", "id");
    }

    function campanas() {
        return $this->hasMany("App\Models\Campana", "experimento_id", "id");
    }
    
}
