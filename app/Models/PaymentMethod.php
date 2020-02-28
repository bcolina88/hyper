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
        'method','name','rif','phone','active','created_at', 'updated_at'
    ];


     

}
