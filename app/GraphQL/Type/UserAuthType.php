<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\User;
use App\Models\Driver;
use App\Models\Rider;

class UserAuthType extends BaseType
{
    protected $attributes = [
        'name'          => 'UserAuth',
        'description'   => 'A UserAuth'
    ];

    public function fields()
    {
        return [
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
            'driver' => [
                'type' => GraphQL::type('Driver')
            ],
            'rider' => [
                'type' => GraphQL::type('Rider')
            ]
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
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