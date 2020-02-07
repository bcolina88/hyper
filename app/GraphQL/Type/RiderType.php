<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\Rider;
use App\Models\User;


class RiderType extends BaseType
{
    protected $attributes = [
        'name' => 'Rider',
        'description' => 'A Rider',
        'model'       => Rider::class,
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
            'active' => [
                'type' => Type::boolean()
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User'))
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
