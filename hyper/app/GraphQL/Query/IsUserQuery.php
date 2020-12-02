<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Permiso;
use App\Models\Role;

class IsUserQuery extends Query
{
    protected $attributes = [
        'name' => 'IsUserQuery',
        'description' => 'Is user query.'
    ];

    public function type()
    {
        return GraphQL::type('RolePermisosType');

    }

    public function args()
    {
        
    }

    public function resolve($root, $args)
    {

        $user = \Auth::user();
        $role = Role::where('id', $user->role->id)->first();
        $permissions = Permiso::where('rol_id', $user->role->id)->with('maestro')->get();


        return ['role' => $role, 'permisos' => $permissions];

    }
}
