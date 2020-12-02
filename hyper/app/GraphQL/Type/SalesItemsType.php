<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class SalesItemsType extends BaseType
{
   
    protected $attributes = [
        'name' => 'SalesItemsType',
        'description' => 'SalesItems type'
    ];


    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'quantity' => [
                'type' => Type::nonNull(Type::int())
            ],
            'price' => [
                'type' => Type::nonNull(Type::string())
            ],
            'date' => [
                'type' => Type::nonNull(Type::string())
            ],
            'total' => [
                'type' => Type::nonNull(Type::int())
            ],
            'sales' => [
                'type' => Type::nonNull(GraphQL::type('SalesType'))
            ],
            'dish' => [
                'type' => Type::nonNull(GraphQL::type('DishType'))
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