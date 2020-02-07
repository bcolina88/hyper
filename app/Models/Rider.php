<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "riders";


    protected $fillable = [
        'x','y','active', 'created_at','updated_at','user_id'];

     /**
     * @return void
    */
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

}
