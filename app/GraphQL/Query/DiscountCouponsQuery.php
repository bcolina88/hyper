<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\DiscountCoupon;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class DiscountCouponsQuery extends Query {

    protected $attributes = [
        'name' => 'discountCoupons',
        'description' => 'DiscountCoupons list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('DiscountCoupon'));
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $discountCoupons = DiscountCoupon::all();
        return $discountCoupons;
    }
}