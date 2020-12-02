<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Dish;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class DishQuery extends Query
{
    protected $attributes = [
        'name' => 'DishQuery',
        'description' => 'Find an dish.'
    ];

    public function type()
    {
        return GraphQL::type('DishType');
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


    
        return Dish::find($args['id']);

    }
}
