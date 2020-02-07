<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "marca";


    protected $fillable = [
        'name', 'active','created_at','updated_at'
    ];

}
