<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class EmployeeType extends BaseType
{
   
    protected $attributes = [
        'name' => 'EmployeeType',
        'description' => 'Employee type'
    ];


    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'rut' => [
                'type' => Type::nonNull(Type::string())
            ],
            'nombre' => [
                'type' => Type::nonNull(Type::string())
            ],
            'apellido' => [
                'type' => Type::nonNull(Type::string())
            ],
            'telefono' => [
                'type' => Type::nonNull(Type::string())
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'sueldo_mensual' => [
                'type' => Type::nonNull(Type::string())
            ],
            'sueldo_diario' => [
                'type' => Type::nonNull(Type::string())
            ],
            'fecha' => [
                'type' => Type::nonNull(Type::string())
            ],
            'role' => [
                'type' => Type::nonNull(GraphQL::type('RoleType'))
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
