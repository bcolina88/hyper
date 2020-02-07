<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\RideRequest;
use App\Models\Rider;

class RideRequestType extends BaseType
{
    protected $attributes = [
        'name' => 'RideRequest',
        'description' => 'A RideRequest',
        'model'       => RideRequest::class,
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
            'carType' => [
                'type' => Type::nonNull(Type::string())
            ],
            'rider' => [
                'type' => Type::nonNull(GraphQL::type('Rider'))
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
