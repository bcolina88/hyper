<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjetivoPalanca extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "objetivo_palancas";
    
    protected $fillable = [
        'objetivo_id', 'palanca_id'
    ];

    public function objetivo()
    {
        return $this->belongsTo('App\Models\Objetivo','objetivo_id','id');
    }

    public function palanca()
    {
        return $this->belongsTo('App\Models\Palanca','palanca_id','id');
    }
    

}
