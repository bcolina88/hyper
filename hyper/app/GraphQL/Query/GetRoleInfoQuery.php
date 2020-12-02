<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Role;
use App\Models\Permiso;

class GetRoleInfoQuery extends Query
{
    protected $attributes = [
        'name' => 'getRoleInfo',
        'description' => 'Find an role and permission.'
    ];

    public function type()
    {
        return GraphQL::type('RolePermisosType');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args)
    {

        
        //return Role::find($args['id']);

        $role = Role::where('id', $args['id'])->first();
        $permissions = Permiso::where('rol_id', $args['id'])->with('maestro')->get();

        return ['role' => $role, 'permisos' => $permissions];
   


    }
}
