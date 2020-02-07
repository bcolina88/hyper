<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\TravelRate;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class TravelRatesQuery extends Query {

    protected $attributes = [
        'name' => 'travelRates',
        'description' => 'TravelRates list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('TravelRate'));
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $TravelRates = TravelRate::all();
        return $TravelRates;
    }
}