<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\DiscountCoupon;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class DiscountCouponQuery extends Query
{
    protected $attributes = [
        'name' => 'discountCouponByID',
        'description' => 'Find an discountCoupon.'
    ];

    public function type()
    {
        return GraphQL::type('DiscountCoupon');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        return DiscountCoupon::find($args['id']);

    }
}
