<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Car;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class CarQuery extends Query
{
    protected $attributes = [
        'name' => 'carByID',
        'description' => 'Find an car.'
    ];

    public function type()
    {
        return GraphQL::type('Car');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/


        return Car::find($args['id']);

    }
}
