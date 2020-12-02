<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Palanca extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "palancas";
     
    protected $fillable = [
        'name','created_at','updated_at','active','estrategia','objetivo_id','completada','num_exp_valid'
    ];

    function objetivo() {
        return $this->belongsTo("App\Models\Objetivo", "objetivo_id", "id");
    }

    function experimentos() {
        return $this->hasMany("App\Models\Experimento", "palanca_id", "id");
    }
    
}
