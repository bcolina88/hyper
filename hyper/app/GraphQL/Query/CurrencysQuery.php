<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Currency;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class CurrencysQuery extends Query
{
    protected $attributes = [
        'name' => 'currencys',
        'description' => 'Currencys list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('CurrencyType'));
    }

    public function args()
    {
       
    }

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/
        
        $currencys = Currency::all();
        return $currencys;

    }
}
