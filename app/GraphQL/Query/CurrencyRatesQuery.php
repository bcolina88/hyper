<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\CurrencyRate;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class CurrencyRatesQuery extends Query {

    protected $attributes = [
        'name' => 'currencyRates',
        'description' => 'currencyRates list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('CurrencyRate'));
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $currencyRates = CurrencyRate::all();
        return $currencyRates;
    }
}