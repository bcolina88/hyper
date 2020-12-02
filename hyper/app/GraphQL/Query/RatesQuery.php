<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Rate;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class RatesQuery extends Query
{
    protected $attributes = [
        'name' => 'rates',
        'description' => 'Rates list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('RateType'));
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
        
        $rates = Rate::all();
        return $rates;

    }
}
