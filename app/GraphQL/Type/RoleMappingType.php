<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleMapping;


class RoleMappingType extends BaseType
{
    protected $attributes = [
        'name' => 'RoleMapping',
        'description' => 'A roleMapping',
        'model'       => RoleMapping::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
            'role' => [
                'type' => Type::nonNull(GraphQL::type('Role'))
            ]
        ];
    }
}
