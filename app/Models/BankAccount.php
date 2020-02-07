<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "bank_accounts";


    protected $fillable = [   
        'accountNumber','currency','comment','type','created_at','updated_at','owner_id','bank_id',
        'beginningBalance','currentBalance'
    ];
    
    /**
     * 
     *
     * @return void
     */
   public function owner()
    {
        return $this->belongsTo('App\Models\User','owner_id','id');
    }

    /**
     * 
     *
     * @return void
     */
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank','bank_id','id');
    }
}
