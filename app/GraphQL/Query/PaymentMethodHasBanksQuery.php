<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\PaymentMethodHasBank;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class PaymentMethodHasBanksQuery extends Query
{
    protected $attributes = [
        'name' => 'PaymentMethodHasBanks',
        'description' => 'PaymentMethodHasBanks list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('PaymentMethodHasBank'));
    }

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $PaymentMethodHasBanks = PaymentMethodHasBank::all();
        return $PaymentMethodHasBanks;

    }
}
