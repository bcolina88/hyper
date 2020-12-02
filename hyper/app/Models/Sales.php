<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "sales";
    
    protected $fillable = [
        'waiter_id','table_id','numberPeople','date','total','status','created_at','updated_at','observation',
    ];

    public function table()
    {

        return $this->belongsTo('App\Models\Table','table_id','id');
    }

    public function waiter()
    {

        return $this->belongsTo('App\Models\Employee','waiter_id','id');
    }
       

}
