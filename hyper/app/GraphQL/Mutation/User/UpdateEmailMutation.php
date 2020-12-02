<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\Models\User;
use App\Models\RoleMapping;
use App\Models\Role;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateEmailMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateEmailUser',
        'description' => 'Update a email of the user'

    ];

    public function type()
    {
        return GraphQL::type('UserType');
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'email' => ['type' => Type::string(),'rules' => ['required', 'email', 'unique:users']],
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
            'email' => $args['email']
        ]);

        return $user;
    }

}