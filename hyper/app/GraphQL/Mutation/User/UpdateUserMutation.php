<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;



class UpdateUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateUser'
    ];

    public function type()
    {
        return GraphQL::type('UserType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'lastName' => ['name' => 'lastName', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'phone' => ['name' => 'phone', 'type' => Type::string()],
            'username' => ['name' => 'username', 'type' => Type::string()],
            'role' => ['name' => 'role', 'type' => Type::nonNull(Type::id())],

        ];
    }


    public function resolve($root, $args)
    {
        $user = User::find($args['id']);

        if(! $user)
        {
            return null;
        }

        // update user        
        $user->update([
            'name'     => $args['name'],
            'email'    => $args['email'],
            'lastName' => $args['lastName'],
            'phone'    => $args['phone'],
            'username' => $args['username'],
            'role_id'  => $args['role'],
        ]);

        return $user;
    }

}