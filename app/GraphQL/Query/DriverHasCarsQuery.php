<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\DriverHasCar;
use JWTAuth;

class DriverHasCarsQuery extends Query
{
    protected $attributes = [
        'name' => 'DriverHasCars',
        'description' => 'DriverHasCars.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('DriverHasCar'));
    }


    public function resolve($root, $args, $context, ResolveInfo $info)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        //return DriverHasCar::all();
        $DriverHasCar = DriverHasCar::all();
        return $DriverHasCar;

    }
}
