<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "banks";


    protected $fillable = [
        'name', 'created_at','updated_at','currency_id','code'
    ];

    
    /**
     * 
     *
     * @return void
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','currency_id','id');
    }
}
