<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMapping extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "roleMappings";
    
    protected $fillable = [
        'user_id', 'role_id'
    ];
    
    /**
     * RoleMapping who owns a user.
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    /**
     * RoleMapping who owns a role.
     *
     * @return void
     */
    public function role()
    {
        return $this->belongsTo('App\Role','role_id','id');
    }
}
