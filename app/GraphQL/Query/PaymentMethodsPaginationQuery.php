<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\PaymentMethod;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JWTAuth;

class PaymentMethodsPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'PaymentMethodsPagination',
        'description' => 'PaymentMethods list.'
    ];

    public function type()
    {
       return GraphQL::type('PaymentMethodPagination');
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
        $PaymentMethods = PaymentMethod::skip($skip)->take(env('LIMIT', 10))->get();
        $total = PaymentMethod::count();

        return ['data' => $PaymentMethods, 'total' => $total];
    }
}