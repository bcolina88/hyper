<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class RoleMappingType extends BaseType
{

    protected $attributes = [
        'name' => 'RoleMappingType',
        'description' => 'RoleMapping type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('UserType'))
            ],
            'role' => [
                'type' => Type::nonNull(GraphQL::type('RoleType'))
            ]
        ];
    }
}
