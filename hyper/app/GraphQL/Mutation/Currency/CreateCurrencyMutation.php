<?php

namespace App\GraphQL\Mutation\Currency;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Currency;
use JWTAuth;

class CreateCurrencyMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateCurrency',
        'description' => 'Create a new currency.'
    ];

    public function type()
    {
        return GraphQL::type('CurrencyType');
    }

    public function args()
    {
        return [
            'description' => [
                'type' => Type::nonNull(Type::string())
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
            'description' => $args['description'],
            'active' => 1
        ];

        $currency = Currency::create($data);

        return $currency;

    }
}
