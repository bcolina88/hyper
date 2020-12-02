<?php

namespace App\GraphQL\Mutation\Employee;

use GraphQL;
use App\Models\Employee;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteEmployeeMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteEmployee',
        'description' => 'Delete a employee.'

    ];

    public function type()
    {
        return GraphQL::type('EmployeeType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
   
        
        if( $employee = Employee::findOrFail($args['id']) ) {
            $employee->delete();
            return $employee;
        }
        return null;
    }

}