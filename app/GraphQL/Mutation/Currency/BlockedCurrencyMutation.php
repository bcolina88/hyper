<?php

namespace App\GraphQL\Mutation\Currency;

use GraphQL;
use App\Models\Currency;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class BlockedCurrencyMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteCurrency',
        'description' => 'Blocked a currency.'

    ];

    public function type()
    {
        return GraphQL::type('CurrencyType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::int())]
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

        $currency = Currency::find($args['id']);

        if($currency) {

            $currency->active = $args['status'];
            $currency->save();
            return $currency;
        }


        return null;
    }

}