<?php

namespace App\GraphQL\Mutation\Currency;

use GraphQL;
use App\Models\Currency;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use JWTAuth;

class UpdateCurrencyMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateCurrency',
        'description' => 'Update a currency.'

    ];

    public function type()
    {
        return GraphQL::type('CurrencyType');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'description' => [ 'type' => Type::string()]

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

        if(!$currency)
        {
            return null;
        }

        $currency->update([
            'description' => $args['description']
        ]);

        return $currency;

    }

}