<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "providers";


    protected $fillable = [
       'company','rif','name','description','email','phone','address','created_at','updated_at','active'
    ];
    
}
