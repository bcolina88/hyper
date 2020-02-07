<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "rides";


    protected $fillable = [
        'totalPaid','pendingPayment','totalPrice','distance','xOrig','yOrig','xDest','yDest','pickupTime', 'dropoffTime', 'rider_id', 'driver_id', 'car_id', 'duration', 'pickupAddr', 'destAddr', 'note', 'travellers', 'status', 'payment','created_at','updated_at','pets'];

     /**
     * @return void
    */
    public function rider()
    {

        return $this->belongsTo('App\Models\Rider','rider_id','id');
    }


     /**
     * @return void
    */
    public function driver()
    {

        return $this->belongsTo('App\Models\Driver','driver_id','id');
    }


     /**
     * @return void
    */
    public function car()
    {

        return $this->belongsTo('App\Models\Car','car_id','id');
    }


}
