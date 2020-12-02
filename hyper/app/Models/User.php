<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastName','avatar', 'email', 'password','phone' ,'username','role_id','active','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes casting for serialization.
     *
     * @var array
     */
    protected $casts = ['id' => 'int'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
//    protected $appends = ['getIsFollowedAttribute'];



    public function role()
    {

        return $this->belongsTo('App\Models\Role','role_id','id');
    }


    public function proyects() {
        return $this->hasMany("App\Models\UserProyect", "user_id", "id");
    }
}
