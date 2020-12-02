<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    protected $table = "expenses";

    protected $fillable = [
        'nombre', 'metodo_pago', 'monto', 'fecha','created_at','updated_at'
    ];
}
