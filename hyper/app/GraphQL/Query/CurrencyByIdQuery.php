<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Currency;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class CurrencyByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'currencyById',
        'description' => 'currencyById list.'
    ];

    public function type()
    {
        

        return GraphQL::type('CurrencyType');

    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
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

        if (isset($args['id'])) {


            return Currency::find($args['id']);



        }


    }
}
