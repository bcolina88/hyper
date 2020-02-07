<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Location;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class LocationQuery extends Query
{
    protected $attributes = [
        'name' => 'LocationByID',
        'description' => 'Find an Location.'
    ];

    public function type()
    {
        return GraphQL::type('Location');
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


        return Location::find($args['id']);

    }
}
