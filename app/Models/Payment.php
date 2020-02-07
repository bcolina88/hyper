<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "payments";


    protected $fillable = [
        'amount','reference','comment','type','bankAccount_id','created_at', 'updated_at', 'createdBy_id', 'updatedBy_id'
    ];


        /**
     * Payment who owns a bankAccount.
     *
     * @return void
     */
    public function bankAccount()
    {
        return $this->belongsTo('App\Models\BankAccount','bankAccount_id','id');
    }

    /**
     * PurchaseRequest who owns a user.
     *
     * @return void
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User','createdBy_id','id');
    }

    /**
     * PurchaseRequest who owns a user.
     *
     * @return void
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User','updatedBy_id','id');
    }


}
