<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleMapping;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdateUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateUser',
        'description' => 'Update a user.'

    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => [ 'type' => Type::string()],
            'lastName' => ['type' => Type::string()],
            'phone' => ['type' => Type::string()],
            'dni' => [ 'type' => Type::string()],
            'birthDate' => ['type' => Type::string()],
            'username' => ['type' => Type::string()],
            'role' => ['type' => Type::int()],
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


        $user = User::find($args['id']);

        if(! $user)
        {
            return null;
        }

        $role = RoleMapping::where('user_id', $args['id']);
        $role->update(['role_id' => $args['role']]);


        // update user
        $user->update([
            'name' => $args['name'],
            'lastName' => $args['lastName'],
            'phone' => $args['phone'],
            'dni' => $args['dni'],
            'role_id'=> $args['role'],
            'fullName' => $args['name'].' '.$args['lastName'],
            'birthDate' => $args['birthDate'],
            'username' => $args['username']

        ]);

        return $user;
    }

}