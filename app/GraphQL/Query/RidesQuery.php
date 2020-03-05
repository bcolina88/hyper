<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Ride;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class RidesQuery extends Query
{
    protected $attributes = [
        'name' => 'rides',
        'description' => 'Rides list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Ride'));
    }

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $Rides = Ride::all();
        return $Rides;

    }
}
