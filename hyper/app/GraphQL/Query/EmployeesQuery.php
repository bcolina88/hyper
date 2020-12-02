<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Employee;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class EmployeesQuery extends Query {

    protected $attributes = [
        'name' => 'Employees',
        'description' => 'Employees list.'
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
       
        $employees = Employee::all();
        return $employees;
    }
}