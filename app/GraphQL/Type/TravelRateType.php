<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\TravelRate;
use App\Models\Currency;
use App\Models\User;

class TravelRateType extends BaseType
{
    protected $attributes = [
        'name' => 'TravelRate',
        'description' => 'A travel rate',
        'model'       => TravelRate::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'x' => [
                'type' => Type::nonNull(Type::string())
            ],
            'y' => [
                'type' => Type::nonNull(Type::string())
            ],
            'value' => [
                'type' => Type::nonNull(Type::string())
            ],
            'adrees' => [
                'type' => Type::nonNull(Type::string())
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'distance' => [
                'type' => Type::nonNull(Type::int())
            ],
            'currency' => [
                'type' => Type::nonNull(GraphQL::type('Currency'))
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'createdBy' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
            'updatedBy' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
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
