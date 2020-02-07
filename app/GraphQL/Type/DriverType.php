<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\Driver;
use App\Models\User;

class DriverType extends BaseType
{
    protected $attributes = [
        'name' => 'Driver',
        'description' => 'A Driver',
        'model'       => Driver::class,
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
            'kmWorked' => [
                'type' => Type::nonNull(Type::string())
            ],
            'availableTravelOtherStates' => [
                'type' => Type::boolean()
            ],
            'nightTripsAvailable' => [
                'type' => Type::boolean()
            ],
            'active' => [
                'type' => Type::boolean()
            ],
            'status' => [
                'type' => Type::boolean()
            ],
            'accountStatus' => [
                'type' => Type::nonNull(Type::string())
            ],
            'residenceAddress' => [
                'type' => Type::nonNull(Type::string())
            ],
            'profilePicture' => [
                'type' => Type::nonNull(Type::string())
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string())
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
