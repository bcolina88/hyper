<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideRequest extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "ride_requests";


    protected $fillable = [
        'x','y','car_type', 'rider_id','created_at','updated_at'];


     /**
     * @return void
    */
    public function rider()
    {

        return $this->belongsTo('App\Models\Rider','rider_id','id');
    }


}
