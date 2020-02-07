<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCar extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "models";


    protected $fillable = [
        'name','active', 'created_at','updated_at','marca_id'
    ];


    /**
     *
     *
     * @return void
     */
    public function marca()
    {
        return $this->belongsTo('App\Models\Marca','marca_id','id');
    }
}
