<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "rates";
    
    protected $fillable = [
        'active','value','created_at','updated_at','currency_id'
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
