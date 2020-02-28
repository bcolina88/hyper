<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\PaymentMethodHasBank;
use App\Models\PaymentMethod;
use App\Models\Bank;

class PaymentMethodHasBankType extends BaseType
{
    protected $attributes = [
        'name' => 'PaymentMethodHasBank',
        'description' => 'A PaymentMethodHasBank',
        'model'       => PaymentMethodHasBank::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'method' => [
                'type' => Type::nonNull(Type::string())
            ],
            'name' => [
                'type' => Type::nonNull(Type::string())
            ],
            'rif' => [
                'type' => Type::string()
            ],
            'phone' => [
                'type' => Type::string()
            ],
            'active' => [
                'type' => Type::boolean()
            ],
            'bank_account' => [
                'type' => Type::listOf(GraphQL::type('BankAccount')),
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
