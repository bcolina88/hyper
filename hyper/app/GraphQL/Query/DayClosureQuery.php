<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Closure;
use App\Models\Expense;
use App\Models\Employee;
use App\Models\Sales;
use App\Models\Boxe;
use App\Models\PaymentEmployee;
use Carbon\Carbon;


use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class DayClosureQuery extends Query {

    protected $attributes = [
        'name' => 'DayClosureQuery',
        'description' => 'Day Closure.'
    ];

    public function type()
    {
        return GraphQL::type('DayClosureType');
    }

    public function args()
    {

    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $date = Carbon::now();
        $date = $date->format('d-m-Y');

        $closure = Closure::where('fecha',$date)->get();

        if (count($closure)>0) {
           $is_closure = true;
        }else{
           $is_closure = false;
        }

       
        $expense = Expense::all()->where('fecha',$date);
        $total_expense = Expense::all()->where('fecha',$date)->sum('monto');
        
        $employeePayment = PaymentEmployee::all()->where('fecha',$date);
        $total_employeePayment = PaymentEmployee::all()->where('fecha',$date)->sum('sueldo_diario');
        
        $sales = Sales::all()->where('date',$date);
        $total_sales = Sales::all()->where('date',$date)->sum('total');


        $total_efectivo = Sales::where('date',$date)
        ->sum('efectivo');
        //DEBITO es la suma total de el efectivo del dia
        $total_debito = Sales::where('date',$date)
        ->sum('debito');
        //cheque es la suma total de el efectivo del dia
        $total_cheque = Sales::where('date',$date)
        ->sum('cheque');
        //DEBITO es la suma total de el efectivo del dia
        $total_transferencia = Sales::where('date',$date)
        ->sum('transferencia');
        //DEBITO es la suma total de el efectivo del dia
        $total_otros = Sales::where('date',$date)
        ->sum('otros');

        $manana = Boxe::where('fecha','like','%'.$date.'%')
        ->where('tipo','Apertura')
        ->sum('monto');

        $noche = Boxe::where('fecha','like','%'.$date.'%')
        ->where('tipo','Cierre')
        ->sum('monto');


        $efectivoycaja=$total_efectivo+$manana;
        $gastosycaja=$total_expense+$noche;
        $restante = $efectivoycaja-$gastosycaja;


        $notas="";
        $retiro=0;
        $total_cuadre=0;

        $res = array('gastos' => $expense,'pagos'=>$employeePayment,'ventas'=>$sales,'total_efectivo'=>$total_efectivo,'total_debito'=>$total_debito,'total_cheque'=>$total_cheque,'total_transferencia'=>$total_transferencia,'total_otros'=>$total_otros,'caja_apertura'=>$manana,'caja_cierre'=>$noche, 'total_ventas' => $total_sales,'total_pago' => $total_employeePayment,'total_gastos' => $total_expense,'restante'=>$restante, 'is_closure'=>$is_closure, 'notas' => $notas, 'retiro' => $retiro, 'total_cuadre' => $total_cuadre);

        return $res;
    }
}