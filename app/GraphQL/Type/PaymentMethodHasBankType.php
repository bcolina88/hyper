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
            'paymentMethod' => [
                'type' => Type::nonNull(GraphQL::type('PaymentMethod')),
            ],
            'bankAccount' => [
                'type' => Type::nonNull(GraphQL::type('BankAccount')),
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
