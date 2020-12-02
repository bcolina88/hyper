<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campana extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "campanas";
     
    protected $fillable = [
        'name','fecha_inicial','fecha_fin','tiempo','presupuesto','completada','created_at','updated_at',
        'active','palanca_id','user_id','alcance'
    ];


    function user() {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }

     function palanca() {
        return $this->belongsTo("App\Models\Palanca", "palanca_id", "id");
    }

    
}
