<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectObjetivo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "proyect_objetivos";
    
    protected $fillable = [
        'objetivo_id', 'proyect_id'
    ];

    public function objetivo()
    {
        return $this->belongsTo('App\Models\Objetivo','objetivo_id','id');
    }

    public function proyect()
    {
        return $this->belongsTo('App\Models\Proyect','proyect_id','id');
    }
    

}
