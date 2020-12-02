<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class PermisoType extends BaseType
{
   
     protected $attributes = [
        'name' => 'PermisoType',
        'description' => 'Permiso type'
    ];



    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'agregar' => [
                'type' => Type::nonNull(Type::int())
            ],
            'editar' => [
                'type' => Type::nonNull(Type::int())
            ],
            'ver' => [
                'type' => Type::nonNull(Type::int())
            ],
            'inhabilitar' => [
                'type' => Type::nonNull(Type::int())
            ],
            'borrar' => [
                'type' => Type::nonNull(Type::int())
            ],
            'rol' => [
                'type' => Type::nonNull(GraphQL::type('RoleType'))
            ],
            'maestro' => [
                'type' => Type::nonNull(GraphQL::type('MaestroType'))
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->toDateTimeString();
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at->toDateTimeString();
    }
}