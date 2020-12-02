<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class PaymentEmployeeType extends BaseType
{
   
    protected $attributes = [
        'name' => 'PaymentEmployeeType',
        'description' => 'Payment Employee type'
    ];


    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'sueldo_diario' => [
                'type' => Type::nonNull(Type::string())
            ],
            'fecha' => [
                'type' => Type::nonNull(Type::string())
            ],
            'employee' => [
                'type' => Type::nonNull(GraphQL::type('EmployeeType'))
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->toDateTimeString();
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at->toDateTimeString();
    }
}
