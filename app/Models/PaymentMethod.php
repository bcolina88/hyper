<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "payment_methods";


    protected $fillable = [
        'method','name','rif','phone','active','bank_id','created_at', 'updated_at'
    ];


        /**
     * Payment who owns a bank.
     *
     * @return void
     */
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank','bank_id','id');
    }

}
