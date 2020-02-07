<?php

namespace App\GraphQL\Mutation\CurrencyRate;

use GraphQL;
use JWTAuth;
use App\Models\CurrencyRate;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class BlockedCurrencyRateMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteCurrencyRate',
        'description' => 'Blocked a currency rate.'

    ];

    public function type()
    {
        return GraphQL::type('CurrencyRate');
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

        $rate = CurrencyRate::find($args['id']);

        if($rate) {

            $rate->active = $args['status'];
            $rate->save();
            return $rate;
        }


        return null;
    }

}