<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideHasRating extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "ride_has_ratings";


    protected $fillable = [
        'ride_id', 'rating_id', 'created_at','updated_at'];

    /**
     * @return void
    */
    public function ride()
    {
        return $this->belongsTo('App\Models\Ride','ride_id','id');
    }

    /**
     * @return void
    */
    public function rating()
    {

        return $this->belongsTo('App\Models\Rating','rating_id','id');
    }




}
