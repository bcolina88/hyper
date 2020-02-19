<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiderAddresses extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "rider_addresses";


    protected $fillable = [
        'location_id', 'rider_id', 'created_at','updated_at'];

    /**
     * @return void
    */
    public function discountCoupon()
    {

        return $this->belongsTo('App\Models\Location','location_id','id');
    }

    /**
     * @return void
    */
    public function rider()
    {

        return $this->belongsTo('App\Models\Rider','rider_id','id');
    }




}
