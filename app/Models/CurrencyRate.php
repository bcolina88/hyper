<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "currency_rates";


    protected $fillable = [
       'created_at','updated_at', 'active','value','currency_id','createdBy_id','updatedBy_id'
    ];


     /**
     * @return void
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','currency_id','id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User','createdBy_id','id');
    }


    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User','updatedBy_id','id');
    }

}
