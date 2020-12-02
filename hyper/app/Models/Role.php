<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "roles";
     
    protected $fillable = [
        'name','created_at','updated_at','active'
    ];
    
}
