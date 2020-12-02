<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class SalesType extends BaseType
{
   
     protected $attributes = [
        'name' => 'SalesType',
        'description' => 'Sales type'
    ];



    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'total' => [
                'type' => Type::nonNull(Type::int())
            ],
            'status' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'date' => [
                'type' => Type::nonNull(Type::string())
            ],
            'numberPeople' => [
                'type' => Type::nonNull(Type::int())
            ],
            'table' => [
                'type' => Type::nonNull(GraphQL::type('TableType'))
            ],
            'waiter' => [
                'type' => Type::nonNull(GraphQL::type('EmployeeType'))
            ],
            'observation' => [
                'type' => Type::nonNull(Type::string())
            ],
            'iva' => [
                'type' => Type::nonNull(Type::string())
            ],
            'subtotal' => [
                'type' => Type::nonNull(Type::string())
            ],
            'descuento' => [
                'type' => Type::nonNull(Type::string())
            ],
            'efectivo' => [
                'type' => Type::nonNull(Type::string())
            ],
            'debito' => [
                'type' => Type::nonNull(Type::string())
            ],
            'cheque' => [
                'type' => Type::nonNull(Type::string())
            ],
            'transferencia' => [
                'type' => Type::nonNull(Type::string())
            ],
            'otros' => [
                'type' => Type::nonNull(Type::string())
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