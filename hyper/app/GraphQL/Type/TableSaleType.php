<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class TableSaleType extends BaseType
{
   
    protected $attributes = [
        'name' => 'TableSaleType',
        'description' => 'TableSale type'
    ];


    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'name' => [
                'type' => Type::nonNull(Type::string())
            ],
            'status' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'sale' => [
                'type' => Type::nonNull(Type::int())
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