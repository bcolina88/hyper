<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Employee;

class EmployeeByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'EmployeeByIdQuery',
        'description' => 'Find an employee.'
    ];

    public function type()
    {
        return GraphQL::type('EmployeeType');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args)
    {

        
        return Employee::find($args['id']);

    }
}
