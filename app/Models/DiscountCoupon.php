<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "discount_coupons";


    protected $fillable = [
        'name','discount','expirationDate', 'typeUse', 'active', 'created_at','updated_at'];

 

}
