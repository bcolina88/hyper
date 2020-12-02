<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companie extends Model
{
	protected $fillable = [
        'name', 'email', 'nif', 'web','boss','phone', 'phone2', 'phone3','image','currency_id','adrees'
    ];

    
    public function currency()
    {

        return $this->belongsTo('App\Models\Currency','currency_id','id');
    }



}
