<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\Car;

class UploadCarType extends BaseType
{
    protected $attributes = [
        'name' => 'UploadCar',
        'description' => 'A UploadCar'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'filename' => [
                'type' => Type::nonNull(Type::string())
            ],
            'path' => [
                'type' => Type::nonNull(Type::string())
            ],
            'original_name' => [
                'type' => Type::nonNull(Type::string())
            ],
            'car' => [
                'type' => Type::nonNull(GraphQL::type('Car'))
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
