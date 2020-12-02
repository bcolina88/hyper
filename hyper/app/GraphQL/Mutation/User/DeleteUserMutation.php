<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\Models\User;
use App\Models\RoleMapping;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'Delete a user.'

    ];

    public function type()
    {
        return GraphQL::type('UserType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
        

        
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