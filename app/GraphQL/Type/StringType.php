<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class StringType extends BaseType
{
    protected $attributes = [
        'name' => 'StringType',
        'description' => 'Auth type'
    ];

    public function fields()
    {
        return [
            'token' => [
                'type' => Type::string()
            ]
        ];
    }
}
