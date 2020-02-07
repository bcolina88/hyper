<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeCar extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "type_cars";


    protected $fillable = [
        'name', 'active','created_at','updated_at'
    ];

}
