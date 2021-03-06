<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\User;
use App\Models\Role;
use App\Models\Rider;
use App\Models\Driver;
use DB;

class GetCurrentType extends BaseType
{
    protected $attributes = [
        'name'          => 'GetCurrent',
        'description'   => 'A user'
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
            'profile_picture' => [
                'type' => Type::string()
            ],
            'fullName' => [
                'type' => Type::string()
            ],
            'role' => [
                'type' => Type::nonNull(GraphQL::type('Role'))
            ],
            'driver' => [
                'type' => GraphQL::type('Driver')
            ],
            'rider' => [
                'type' => GraphQL::type('Rider')
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