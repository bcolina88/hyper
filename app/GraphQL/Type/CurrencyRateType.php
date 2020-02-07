<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\CurrencyRate;
use App\Models\Currency;
use App\Models\User;
use App\Models\Rider;

class CurrencyRateType extends BaseType
{
    protected $attributes = [
        'name' => 'CurrencyRate',
        'description' => 'A currency rate',
        'model'       => CurrencyRate::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'value' => [
                'type' => Type::nonNull(Type::string())
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'currency' => [
                'type' => Type::nonNull(GraphQL::type('Currency'))
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'createdBy' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
            'updatedBy' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
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
