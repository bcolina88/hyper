<?php

namespace App\GraphQL\Mutation\Driver;

use GraphQL;
use App\Models\Driver;
use App\Models\User;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class BlockedDriverMutation extends Mutation {

    protected $attributes = [
        'name' => 'bloquedDriver',
        'description' => 'Blocked a Driver.'

    ];

    public function type()
    {
        return GraphQL::type('Driver');
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
        $driver = Driver::where('user_id', $user->id)->first();

        if($driver) {

            $user->active = $args['status'];
            $user->save();

            $driver->active = $args['status'];
            $driver->save();
            return $driver;
        }

        return null;
    }

}