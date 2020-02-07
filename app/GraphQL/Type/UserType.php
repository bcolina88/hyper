<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\User;
use App\Models\Role;

class UserType extends BaseType
{
    protected $attributes = [
        'name'          => 'User',
        'description'   => 'A user',
        'model'         => User::class,
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
            'phone' => [
                'type' => Type::string()
            ],
            'dni' => [
                'type' => Type::string()
            ],
            'birthDate' => [

                'type' => Type::string()
            ],
            'fullName' => [
                'type' => Type::string()
            ],
            'role' => [
                'type' => Type::nonNull(GraphQL::type('Role'))
            ],
            'active' => [
                'type' => Type::boolean()
            ],
            'email' => [
                'type' => Type::string()
            ],
            'created_at' => [
                'type' => Type::string()
            ],
            'updated_at' => [
                'type' => Type::string()
            ]
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->toDateTimeString();
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at->toDateTimeString();
    }
}