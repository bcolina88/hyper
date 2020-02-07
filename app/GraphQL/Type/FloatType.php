<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class FloatType extends BaseType
{
    protected $attributes = [
        'name' => 'FloatType',
        'description' => 'Float Type'
    ];

    public function fields()
    {
        return [
            'distance' => [
                'type' => Type::float()
            ]
        ];
    }
}
