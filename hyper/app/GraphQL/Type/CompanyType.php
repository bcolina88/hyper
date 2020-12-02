<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class CompanyType extends BaseType
{
    protected $attributes = [
        'name' => 'CompanyType',
        'description' => 'Company type'
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
            'email' => [
                'type' => Type::string()
            ],
            'nif' => [
                'type' => Type::string()
            ],
            'web' => [
                'type' => Type::string()
            ],
            'boss' => [
                'type' => Type::string()
            ],
            'phone' => [
                'type' => Type::string()
            ],
            'phone2' => [
                'type' => Type::string()
            ],
            'phone3' => [
                'type' => Type::string()
            ],
            'adrees' => [
                'type' => Type::string()
            ],
            'image' => [
                'type' => Type::string()
            ],
            'currency' => [
                'type' => GraphQL::type('CurrencyType')
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
