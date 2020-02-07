<?php

namespace App\GraphQL\Mutation\DiscountCoupon;

use GraphQL;
use App\Models\DiscountCoupon;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class DeleteDiscountCouponMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteDiscountCoupon',
        'description' => 'Delete a discountCoupon.'

    ];

    public function type()
    {
        return GraphQL::type('DiscountCoupon');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
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

        if( $discountCoupon = DiscountCoupon::findOrFail($args['id']) ) {
            $discountCoupon->delete();
            return $discountCoupon;
        }
        return null;
    }

}