<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\DriverHasCar;
use App\Models\Driver;
use App\Models\Car;

class DriverHasCarType extends BaseType
{
    protected $attributes = [
        'name' => 'DriverHasCar',
        'description' => 'A driverHasCar',
        'model'       => DriverHasCar::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'car' => [
                'type' => Type::nonNull(GraphQL::type('Car'))
            ],
            'driver' => [
                'type' => Type::nonNull(GraphQL::type('Driver'))
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
