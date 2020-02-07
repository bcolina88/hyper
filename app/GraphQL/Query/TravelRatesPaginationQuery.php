<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\TravelRate;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class TravelRatesPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'travelRatePagination',
        'description' => 'TravelRates list.'
    ];

    public function type()
    {
        return GraphQL::type('TravelRatePagination');
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
        $TravelRates = TravelRate::skip($skip)->take(env('LIMIT', 10))->get();
        $total = TravelRate::count();

        return ['data' => $TravelRates, 'total' => $total];
    }
}