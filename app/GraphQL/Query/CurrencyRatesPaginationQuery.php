<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\CurrencyRate;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class CurrencyRatesPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'currencyRatePagination',
        'description' => 'CurrencyRates list.'
    ];

    public function type()
    {
        return GraphQL::type('CurrencyRatePagination');
    }

    public function args()
    {
        return [
            'page' => [
                'name' => 'page',
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

        $skip = env('LIMIT', 10) * $args['page'];
        $currencyRates = CurrencyRate::skip($skip)->take(env('LIMIT', 10))->get();
        $total = CurrencyRate::count();

        return ['data' => $currencyRates, 'total' => $total];
    }
}