<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverHasCar extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "driver_has_cars";


    protected $fillable = [
        'car_id', 'driver_id', 'created_at','updated_at'];

    /**
     * @return void
    */
    public function car()
    {
        return $this->belongsTo('App\Models\Car','car_id','id');
    }

    /**
     * @return void
    */
    public function driver()
    {

        return $this->belongsTo('App\Models\Driver','driver_id','id');
    }




}
