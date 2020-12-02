<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\Models\User;
use App\Models\RoleMapping;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;


class BlockedUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'Blocked a user.'

    ];

    public function type()
    {
        return GraphQL::type('UserType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::boolean())]
        ];
    }

    public function resolve($root, $args)
    {
        

        $user = User::find($args['id']);
   
        if($user) {

            $user->active = $args['status'];
            $user->save();
            return $user;
        }

       
        return null;
    }

}