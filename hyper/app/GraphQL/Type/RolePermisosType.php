<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class RolePermisosType extends BaseType
{
   
    protected $attributes = [
        'name' => 'RolePermisosType',
        'description' => 'RolePermisos type.'
    ];
    
    public function fields()
    {
        return [
            'role' => [
                'type' => Type::nonNull(GraphQL::type('RoleType'))
            ],
            'permisos' => [
                'type' => Type::listOf(GraphQL::type('PermisoType'))
            ],
        ];
    }

}