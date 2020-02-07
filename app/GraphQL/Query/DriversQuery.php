<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Driver;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class DriversQuery extends Query {

    protected $attributes = [
        'name' => 'drivers',
        'description' => 'Drivers list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Driver'));
    }



   public function resolve($root, $args, $context, ResolveInfo $resolveInfo)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $Driver = Driver::all();
        return $Driver;
    }
}