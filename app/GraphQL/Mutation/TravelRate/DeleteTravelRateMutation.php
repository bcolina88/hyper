<?php

namespace App\GraphQL\Mutation\TravelRate;

use GraphQL;
use JWTAuth;
use App\Models\TravelRate;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class DeleteTravelRateMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteTravelRate',
        'description' => 'Delete a travel rate.'

    ];

    public function type()
    {
        return GraphQL::type('TravelRate');
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

        if( $TravelRate = TravelRate::findOrFail($args['id']) ) {
            $TravelRate->delete();
            return $TravelRate;
        }
        return null;
    }

}