<?php

namespace App\GraphQL\Mutation\Location;

use GraphQL;
use App\Models\Location;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;


class DeleteLocationMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteLocation',
        'description' => 'Delete a Location.'

    ];

    public function type()
    {
        return GraphQL::type('Location');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
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

        if( $Location = Location::findOrFail($args['id']) ) {
            $Location->delete();
            return $Location;
        }
        return null;
    }

}