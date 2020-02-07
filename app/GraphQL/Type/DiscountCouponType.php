<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\DiscountCoupon;

class DiscountCouponType extends BaseType
{
    protected $attributes = [
        'name' => 'DiscountCoupon',
        'description' => 'DiscountCoupon type',
        'model'       => DiscountCoupon::class,
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
            'discount' => [
                'type' => Type::nonNull(Type::string())
            ],
            'typeUse' => [
                'type' => Type::nonNull(Type::int())
            ],
            'expirationDate' => [
                'type' => Type::nonNull(Type::string())
            ],
            'active' => [
                'type' => Type::boolean()
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
