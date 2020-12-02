<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Closure extends Model
{
     protected $fillable = [
            
       'fecha', 'total_efectivo', 'total_debito', 'total_cheque', 'total_transferencia', 'total_otros', 'total_ventas', 'total_pago', 'total_gastos', 'caja_apertura', 'caja_cierre', 'restante', 'notas', 'retiro', 'total_cuadre', 'created_at', 'updated_at'
    ];
    

}



            