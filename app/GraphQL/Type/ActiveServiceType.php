<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\Driver;
use App\Models\Rider;
use App\Models\User;
use App\Models\Car;
use App\Models\Rating;


class ActiveServiceType extends BaseType
{
    protected $attributes = [
        'name' => 'ActiveService',
        'description' => 'Active Services'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'pickupAddr' => [
                'type' => Type::string()
            ],
            'destAddr' => [
                'type' => Type::string()
            ],
            'status' => [
                'type' => Type::string()
            ],
            'price' => [
                'type' => Type::string()
            ],
            'rider' => [
                'type' => GraphQL::type('Rider')
            ],
            'driver' => [
                'type' => GraphQL::type('Driver')
            ],
            'car' => [
                'type' => GraphQL::type('Car')
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
