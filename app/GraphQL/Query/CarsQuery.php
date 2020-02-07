<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Car;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class CarsQuery extends Query
{
    protected $attributes = [
        'name' => 'cars',
        'description' => 'Cars list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Car'));
    }

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $Cars = Car::all();
        return $Cars;

    }
}
