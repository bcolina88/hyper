<?php

namespace App\GraphQL\Mutation\Employee;

use GraphQL;
use App\Models\Employee;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class BlockedEmployeeMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteEmployee',
        'description' => 'Blocked a employee.'

    ];

    public function type()
    {
        return GraphQL::type('EmployeeType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::boolean())]
        ];
    }

    public function resolve($root, $args)
    {
        
       
        $employee = Employee::find($args['id']);
   
        if($employee) {
            
            $employee->active = $args['status'];
            $employee->save();
            return $employee;
        }
        
        return null;
    }

}