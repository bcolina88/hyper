<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class DishType extends BaseType
{
   
    protected $attributes = [
        'name' => 'DishType',
        'description' => 'Dish type.'
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
            'description' => [
                'type' => Type::nonNull(Type::string())
            ],
            'code' => [
                'type' => Type::nonNull(Type::string())
            ],
            'image' => [
                'type' => Type::nonNull(Type::string())
            ],
            'unity' => [
                'type' => Type::nonNull(Type::string())
            ],
            'duration' => [
                'type' => Type::nonNull(Type::string())
            ],
            'preparation' => [
                'type' => Type::nonNull(Type::string())
            ],
            'price' => [
                'type' => Type::nonNull(Type::string())
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'category' => [
                'type' => Type::nonNull(GraphQL::type('CategoryType'))
            ],
            'stock' => [
                'type' => Type::nonNull(Type::int())
            ],
            'stock_min' => [
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