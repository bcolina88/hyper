<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\Payment;
use App\Models\BankAccount;
use App\Models\User;
use App\Models\Rider;


class PaymentType extends BaseType
{
    protected $attributes = [
        'name' => 'Payment',
        'description' => 'A Payment',
        'model'       => Payment::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'amount' => [
                'type' => Type::nonNull(Type::string())
            ],
            'reference' => [
                'type' => Type::nonNull(Type::string())
            ],
            'comment' => [
                'type' => Type::string()
            ],
            'type' => [
                'type' => Type::nonNull(Type::string())
            ],
            'bankAccount' => [
                'type' => Type::nonNull(GraphQL::type('BankAccount'))
            ],
            'createdBy' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
            'updatedBy' => [
                'type' => Type::nonNull(GraphQL::type('User'))
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
