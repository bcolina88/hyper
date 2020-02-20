<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\Ride;
use App\Models\Rider;
use App\Models\Driver;
use App\Models\Car;
use App\Models\RideRequest;

class RideType extends BaseType
{
    protected $attributes = [
        'name' => 'Ride',
        'description' => 'A Ride',
        'model'       => Ride::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'xOrig' => [
                'type' => Type::string()
            ],
            'yOrig' => [
                'type' => Type::string()
            ],
            'xDest' => [
                'type' => Type::string()
            ],
            'yDest' => [
                'type' => Type::string()
            ],
            'pickupTime' => [
                'type' => Type::string()
            ],
            'totalPrice' => [
                'type' => Type::string(),
            ],
            'pendingPayment' => [
                'type' => Type::string()
            ],
            'totalPaid' => [
                'type' => Type::string()
            ],
            'dropoffTime' => [
                'type' => Type::string()
            ],
            'duration' => [
                'type' =>  Type::int()
            ],
            'distance' => [
                'type' =>  Type::int()
            ],
            'pets' => [
                'type' =>  Type::string()
            ],
            'luggage' => [
                'type' =>  Type::string()
            ],
            'pickupAddr' => [
                'type' =>  Type::string()
            ],
            'destAddr' => [
                'type' =>  Type::string()
            ],
            'note' => [
                'type' =>  Type::string()
            ],
            'travellers' => [
                'type' =>  Type::int()
            ],
            'status' => [
                'type' =>  Type::int()
            ],
            'payment' => [
                'type' =>  Type::int()
            ],
            'rider' => [
                'type' =>  GraphQL::type('Rider')
            ],
            'driver' => [
                'type' =>  GraphQL::type('Driver')
            ],
            'car' => [
                'type' =>  GraphQL::type('Car')
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
