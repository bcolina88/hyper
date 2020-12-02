<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boxe extends Model
{
    
    protected $table = "boxes";

    protected $fillable = [
    
          'descripcion','fecha','monto','tipo','created_at','updated_at'
 
    ];

    
}
