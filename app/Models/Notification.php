<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "notifications";


    protected $fillable = [
        'title','description','state','created_at','updated_at','fromUser_id','toUser_id',
    ];


    public function fromUser()
    {
        return $this->belongsTo('App\Models\User','fromUser_id','id');
    }

    public function toUser()
    {
        return $this->belongsTo('App\Models\User','toUser_id','id');
    }


}
