<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\BankAccount;
use App\Models\Bank;
use App\Models\User;

class BankAccountType extends BaseType
{
    protected $attributes = [
        'name' => 'BankAccount',
        'description' => 'BankAccount type',
        'model'       => BankAccount::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'type' => [
                'type' => Type::nonNull(Type::string())
            ],
            'currency' => [
                'type' => Type::nonNull(Type::string())
            ],
            'accountNumber' => [
                'type' => Type::nonNull(Type::string())
            ],
            'comment' => [
                'type' => Type::nonNull(Type::string())
            ],
            'beginningBalance' => [
                'type' => Type::nonNull(Type::string())
            ],
            'currentBalance' => [
                'type' => Type::nonNull(Type::string())
            ],
            'bank' => [
                'type' => Type::nonNull(GraphQL::type('Bank'))
            ],
            'owner' => [
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
