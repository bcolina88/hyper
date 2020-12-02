<?php

namespace App\GraphQL\Mutation\Role;

use GraphQL;
use App\Models\Role;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class BlockedRoleMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteRole',
        'description' => 'Blocked a role.'

    ];

    public function type()
    {
        return GraphQL::type('RoleType');
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
        
       
        $role = Role::find($args['id']);
   
        if($role) {
            
            $role->active = $args['status'];
            $role->save();
            return $role;
        }
        
        return null;
    }

}