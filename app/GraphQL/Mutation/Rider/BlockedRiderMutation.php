<?php

namespace App\GraphQL\Mutation\Rider;

use GraphQL;
use App\Models\Rider;
use App\Models\User;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class BlockedRiderMutation extends Mutation {

    protected $attributes = [
        'name' => 'bloquedRider',
        'description' => 'Blocked a Rider.'

    ];

    public function type()
    {
        return GraphQL::type('Rider');
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

        $user = User::where('id', $args['id'])->first();
        $Rider = Rider::where('user_id', $user->id)->first();

        if($Rider) {

            $user->active = $args['status'];
            $user->save();

            $Rider->active = $args['status'];
            $Rider->save();
            return $Rider;
        }


        return null;
    }

}