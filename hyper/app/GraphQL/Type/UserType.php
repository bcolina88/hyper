<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType {

    protected $attributes = [
        'name' => 'UserType',
        'description' => 'User type.'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'name' => [
                'type' => Type::string()
            ],
            'lastName' => [
                'type' => Type::string()
            ],
            'username' => [
                'type' => Type::string()
            ],
            'email' => [
                'type' => Type::string()
            ],
            'phone' => [
                'type' => Type::string()
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'created_at' => [
                'type' => Type::string()
            ],
            'updated_at' => [
                'type' => Type::string()
            ],
            'role' => [
                'type' => Type::nonNull(GraphQL::type('RoleType'))
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