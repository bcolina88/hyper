<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = "uploads";


    protected $fillable = [
        'path','car_id','filename','original_name','created_at','updated_at'];

    /**
     * @return void
    */
    public function car()
    {
        return $this->belongsTo('App\Models\Car','car_id','id');
    }
}
