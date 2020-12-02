<?php

namespace App\GraphQL\Mutation\Currency;

use GraphQL;
use App\Models\Currency;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use JWTAuth;

class DeleteCurrencyMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteCurrency',
        'description' => 'Delete a currency.'

    ];

    public function type()
    {
        return GraphQL::type('CurrencyType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
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

        if( $currency = Currency::findOrFail($args['id']) ) {
            $currency->delete();
            return $currency;
        }
        return null;
    }

}