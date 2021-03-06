<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "locations";


    protected $fillable = [
       'x','y','address','percentagePriceIncrease','durationIncrease','increaseStartDate','name', 'created_at','updated_at'
    ];

}
