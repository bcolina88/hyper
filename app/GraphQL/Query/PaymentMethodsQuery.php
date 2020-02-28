<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\PaymentMethod;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class PaymentMethodsQuery extends Query
{
    protected $attributes = [
        'name' => 'PaymentMethods',
        'description' => 'PaymentMethods list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('PaymentMethod'));
    }

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $PaymentMethods = PaymentMethod::all();
        return $PaymentMethods;

    }
}
