<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\Models\User;
use App\Models\RoleMapping;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class DeleteUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'Delete a user.'

    ];

    public function type()
    {
        return GraphQL::type('User');
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


        if($role = RoleMapping::where('user_id', $args['id'])){

            $role->delete();
            if( $user = User::findOrFail($args['id']) ) {
                $user->delete();
                return $user;
            }

        }

        return null;
    }

}