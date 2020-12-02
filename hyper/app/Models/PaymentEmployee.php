<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentEmployee extends Model
{
    protected $fillable = [
        'employee_id', 'fecha','created_at','updated_at','sueldo_diario'

    ];

    public function employee()
    {
         return $this->belongsTo('App\Models\Employee','employee_id', 'id');
    }
    
}
