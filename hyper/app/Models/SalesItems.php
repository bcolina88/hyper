<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesItems extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "sales_items";
    
    protected $fillable = [
        'sales_id','dish_id','quantity','price','total','date','created_at','updated_at'
    ];

    public function sales()
    {

        return $this->belongsTo('App\Models\Sales','sales_id','id');
    }

    public function dish()
    {

        return $this->belongsTo('App\Models\Dish','dish_id','id');
    }
       

}
