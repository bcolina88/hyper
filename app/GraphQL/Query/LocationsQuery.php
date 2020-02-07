<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Location;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class LocationsQuery extends Query
{
    protected $attributes = [
        'name' => 'locations',
        'description' => 'Locations list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Location'));
    }

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $Locations = Location::all();
        return $Locations;

    }
}
