<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\DiscountCoupon;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class DiscountCouponsPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'discountCouponPagination',
        'description' => 'DiscountCoupons list.'
    ];

    public function type()
    {
        return GraphQL::type('DiscountCouponPagination');
    }

    public function args()
    {
        return [
            'page' => [
                'name' => 'page',
                'type' => Type::nonNull(Type::int())
            ]
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

        $skip = env('LIMIT', 10) * $args['page'];
        $discountCoupons = DiscountCoupon::skip($skip)->take(env('LIMIT', 10))->get();
        $total = DiscountCoupon::count();

        return ['data' => $discountCoupons, 'total' => $total];
    }
}