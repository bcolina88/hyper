<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\RiderHasCoupon;
use App\Models\Rider;
use App\Models\DiscountCoupon;

class RiderHasCouponType extends BaseType
{
    protected $attributes = [
        'name' => 'RiderHasCoupon',
        'description' => 'A riderHasCoupon',
        'model'       => RiderHasCoupon::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'rider' => [
                'type' => Type::nonNull(GraphQL::type('Rider'))
            ],
            'discountCoupon' => [
                'type' => Type::nonNull(GraphQL::type('DiscountCoupon'))
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
