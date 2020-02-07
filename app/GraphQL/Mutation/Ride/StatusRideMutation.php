<?php

namespace App\GraphQL\Mutation\Ride;

use GraphQL;
use JWTAuth;
use App\Models\Ride;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class StatusRideMutation extends Mutation {

    protected $attributes = [
        'name' => 'statusRide',
        'description' => 'Status a ride.'

    ];

    public function type()
    {
        return GraphQL::type('Ride');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::int())]
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

        $ride = Ride::find($args['id']);

        if($ride) {

            $ride->status = $args['status'];
            $ride->save();
            return $ride;
        }


        return null;
    }

}