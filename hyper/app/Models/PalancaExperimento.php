<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PalancaExperimento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "palanca_experimentos";
    
    protected $fillable = [
        'experimento_id', 'palanca_id'
    ];

    public function experimento()
    {
        return $this->belongsTo('App\Models\Experimento','experimento_id','id');
    }

    public function palanca()
    {
        return $this->belongsTo('App\Models\Palanca','palanca_id','id');
    }
    

}
