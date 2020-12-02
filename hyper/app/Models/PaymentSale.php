<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSale extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "payment_sales";
    
    protected $fillable = [
        'currency_id','sale_id','created_at','updated_at','efectivo','debito','cheque','transferencia','otros',
    ];

    public function currency()
    {

        return $this->belongsTo('App\Models\Currency','currency_id','id');
    }

    public function sale()
    {

        return $this->belongsTo('App\Models\Sale','sale_id','id');
    }
       

}
