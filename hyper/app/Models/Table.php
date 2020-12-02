<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "tables";
    
    protected $fillable = [
        'name','active','created_at','updated_at','status'
    ];

}
