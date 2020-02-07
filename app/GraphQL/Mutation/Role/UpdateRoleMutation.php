<?php

namespace App\GraphQL\Mutation\Role;

use GraphQL;
use App\Models\Role;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdateRoleMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateRole',
        'description' => 'Update a role.'

    ];

    public function type()
    {
        return GraphQL::type('Role');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => [ 'type' => Type::string()],
            'description' => [ 'type' => Type::string()]

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

        if(!$role)
        {
            return null;
        }

        // update role
        $role->update([
            'name' => $args['name'],
            'description' => $args['description']
        ]);

        return $role;

    }

}