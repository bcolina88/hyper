<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Employee;
use App\Models\PaymentEmployee;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;
use Carbon\Carbon;

class EmployeesPaymentsQuery extends Query {

    protected $attributes = [
        'name' => 'EmployeesPayments',
        'description' => 'EmployeesPayments list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('EmployeeType'));
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
       
        //$employees = Employee::all();
       // return $employees;


        $date = Carbon::now();
        $date = $date->format('d-m-Y');


        $empleados =[];
        $result = Employee::orderBy('id','ASC')->get();
        $total_empleados = count($result);


        for ($i=0; $i < $total_empleados; $i++) { 

          $paymentsEmploye = PaymentEmployee::where('fecha','=',$date)->where('employee_id','=',$result[$i]->id)->get();
          if (count($paymentsEmploye) === 0) {
            array_push($empleados,$result[$i]);
          }

        }

        return $empleados;




    }
}