<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\Models\User;
use App\Models\RoleMapping;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class CreateUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'createUser'
    ];

    public function type()
    {
        return GraphQL::type('UserType');
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'name' => 'required|min:2',
            'password' => 'required|min:6',
        ];
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'lastName' => ['name' => 'lastName', 'type' => Type::string()],
            'username' => ['name' => 'username', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'phone' => ['name' => 'phone', 'type' => Type::string()],
            'password' => ['name' => 'password', 'type' => Type::string()],
            'role' => ['name' => 'role', 'type' => Type::id()],

        ];
    }

    public function resolve($root, $args)
    {
        $data = [
            'name'     => $args['name'],
            'lastName'     => $args['lastName'],
            'username'     => $args['username'],
            'email'    => $args['email'],
            'password' => bcrypt($args['password']),
            'lastName' => $args['lastName'],
            'phone'    => $args['phone'],
            'active'=> 1,
            'role_id'=> $args['role']

        ];

        $user = User::create($data);

        RoleMapping::create([
            'user_id'  => $user->id,
            'role_id'  => $args['role']    
        ]);

        return $user;
    }
}