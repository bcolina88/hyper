<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodHasBank extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "payment_method_has_banks";


    protected $fillable = [
        'paymentMethod_id', 'bankAccount_id', 'created_at','updated_at'];

    /**
     * @return void
    */
    public function paymentMethod()
    {

        return $this->belongsTo('App\Models\PaymentMethod','paymentMethod_id','id');
    }

    /**
     * @return void
    */
    public function bankAccount()
    {

        return $this->belongsTo('App\Models\BankAccount','bankAccount_id','id');
    }




}
