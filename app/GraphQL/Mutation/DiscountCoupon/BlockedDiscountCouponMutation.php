<?php

namespace App\GraphQL\Mutation\DiscountCoupon;

use GraphQL;
use App\Models\DiscountCoupon;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class BlockedDiscountCouponMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteDiscountCoupon',
        'description' => 'Blocked a discountCoupon.'

    ];

    public function type()
    {
        return GraphQL::type('DiscountCoupon');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $discountCoupon = DiscountCoupon::find($args['id']);

        if($discountCoupon) {

            $discountCoupon->active = $args['status'];
            $discountCoupon->save();
            return $discountCoupon;
        }


        return null;
    }

}