<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProyect extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "users_proyects";
    
    protected $fillable = [
        'user_id', 'proyect_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function proyect()
    {
        return $this->belongsTo('App\Models\Proyect','proyect_id','id');
    }
    

}
