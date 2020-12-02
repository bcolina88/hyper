<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class BoxeType extends BaseType
{
   
    protected $attributes = [
        'name' => 'BoxeType',
        'description' => 'Boxe type'
    ];


    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'descripcion' => [
                'type' => Type::nonNull(Type::string())
            ],
            'tipo' => [
                'type' => Type::nonNull(Type::string())
            ],
            'monto' => [
                'type' => Type::nonNull(Type::string())
            ],
            'fecha' => [
                'type' => Type::nonNull(Type::string())
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
