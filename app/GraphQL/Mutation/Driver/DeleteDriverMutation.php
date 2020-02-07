<?php

namespace App\GraphQL\Mutation\Driver;

use GraphQL;
use App\Models\Driver;
use App\Models\User;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class DeleteDriverMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteDriver',
        'description' => 'Delete a driver.'

    ];

    public function type()
    {
        return GraphQL::type('Driver');
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

        /*if( $driver = Driver::findOrFail($args['id']) ) {
            $driver->delete();
            return $driver;
        }
        return null;*/

        if( $user = User::findOrFail($args['id']) ) {

            $Driver = Driver::where('user_id',$user->id)->first();
            $Driver->delete();


            $user->delete();
            return $user;
        }
        return null;
    }

}