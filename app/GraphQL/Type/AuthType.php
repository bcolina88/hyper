<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
//use App\Models\Auth;

class AuthType extends BaseType
{
    protected $attributes = [
        'name' => 'Auth',
        'description' => 'Auth type',
        //'model'       => Auth::class,
    ];

    public function fields()
    {
        return [
            'token' => [
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }
}
