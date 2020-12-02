<?php

namespace App\GraphQL\Mutation\Role;

use GraphQL;
use App\Models\Role;
use App\Models\Permiso;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use JWTAuth;

class DeleteRoleMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteRole',
        'description' => 'Delete a role.'

    ];

    public function type()
    {
        return GraphQL::type('RoleType');
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


        if( $role = Role::findOrFail($args['id']) ) {
            
            $permisos = Permiso::where('rol_id',$args['id'])->get();

            foreach ($permisos as $key => $item) {

                Permiso::destroy($item['id']);  
            }

            Role::destroy($args['id']);
            return $role;

        }

        return null;


    }

}