<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\PaymentMethodHasBank;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JWTAuth;

class PaymentMethodHasBanksPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'PaymentMethodHasBanksPagination',
        'description' => 'PaymentMethodHasBanks list.'
    ];

    public function type()
    {
       return GraphQL::type('PaymentMethodHasBankPagination');
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
        $PaymentMethodHasBanks = PaymentMethodHasBank::skip($skip)->take(env('LIMIT', 10))->get();
        $total = PaymentMethodHasBank::count();

        return ['data' => $PaymentMethodHasBanks, 'total' => $total];
    }
}