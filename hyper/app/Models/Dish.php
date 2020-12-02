<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dish extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "dishs";



    protected $fillable = [
       'image','price','preparation','name','description','code','unity','duration','created_at','updated_at','active','category_id','stock','stock_min'
    ];

    public function category()
    {

        return $this->belongsTo('App\Models\Category','category_id','id');
    }
    
}
