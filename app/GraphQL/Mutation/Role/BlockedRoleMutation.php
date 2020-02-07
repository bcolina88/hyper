<?php

namespace App\GraphQL\Mutation\Role;

use GraphQL;
use App\Models\Role;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class BlockedRoleMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteRole',
        'description' => 'Blocked a role.'

    ];

    public function type()
    {
        return GraphQL::type('Role');
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

        $role = Role::find($args['id']);

        if($role) {

            $role->active = $args['status'];
            $role->save();
            return $role;
        }


        return null;
    }

}