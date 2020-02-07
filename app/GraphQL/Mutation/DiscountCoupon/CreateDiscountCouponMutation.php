<?php

namespace App\GraphQL\Mutation\DiscountCoupon;

use GraphQL;
use JWTAuth;
use App\Models\DiscountCoupon;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class CreateDiscountCouponMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createDiscountCoupon',
        'description' => 'Create a new discountCoupon.'
    ];

    public function type()
    {
        return GraphQL::type('DiscountCoupon');
    }

    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string())
            ],
            'discount' => [
                'type' => Type::nonNull(Type::string())
            ],
            'expirationDate' => [
                'type' => Type::nonNull(Type::string())
            ],
            'typeUse' => [
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

        $data = [
            'name'     => $args['name'],
            'active' => 1,
            'discount' => $args['discount'],
            'expirationDate' => $args['expirationDate'],
            'typeUse' => $args['typeUse'],
        ];

        $discountCoupon = DiscountCoupon::create($data);

        return $discountCoupon;

    }
}
