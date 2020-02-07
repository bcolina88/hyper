<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "drivers";


    protected $fillable = [
        'x','y','availableTravelOtherStates', 'nightTripsAvailable', 'active', 'accountStatus', 'residenceAddress','profilePicture','kmWorked','created_at','updated_at','user_id','status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

}
