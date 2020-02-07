<?php

namespace App\GraphQL\Mutation\DiscountCoupon;

use GraphQL;
use App\Models\DiscountCoupon;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdateDiscountCouponMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateDiscountCoupon',
        'description' => 'Update a discountCoupon.'

    ];

    public function type()
    {
        return GraphQL::type('DiscountCoupon');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => [ 'type' => Type::string()],
            'discount' => [ 'type' => Type::string()],
            'expirationDate' => [ 'type' => Type::string()],
            'typeUse' => [ 'type' => Type::int()]

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

        if(!$discountCoupon)
        {
            return null;
        }

        // update discountCoupon
        $discountCoupon->update([
            'name' => $args['name'],
            'discount' => $args['discount'],
            'expirationDate' => $args['expirationDate'],
            'typeUse' => $args['typeUse'],
        ]);

        return $discountCoupon;

    }

}