<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\PaymentMethod;


use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;


class ActivePaymentMethodsQuery extends Query
{
    protected $attributes = [
        'name' => 'activePaymentMethods',
        'description' => 'Active PaymentMethods.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('PaymentMethod'));
    }


    public function resolve($root, $args, $context, ResolveInfo $info)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $PaymentMethod = PaymentMethod::where('active',1)->get();

  

        return $PaymentMethod;


    }
}
