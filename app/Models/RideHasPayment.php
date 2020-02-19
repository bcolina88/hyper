<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideHasPayment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "ride_has_payments";

    protected $fillable = [
        'ride_id','payment_id','created_at','updated_at'];


    public function ride()
    {
        return $this->belongsTo('App\Models\Ride','ride_id','id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment','payment_id','id');
    }

}
