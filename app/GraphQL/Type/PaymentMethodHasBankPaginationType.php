<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\PaymentMethodHasBank;


class PaymentMethodHasBankPaginationType extends BaseType
{
    protected $attributes = [
        'name' => 'PaymentMethodHasBankPagination',
        'description' => 'A pagination'
    ];

    public function fields()
    {
        return [
            'data' => [
                'type' => Type::listOf(GraphQL::type('PaymentMethodHasBank')),
                'description' => 'PaymentMethodHasBanks'
            ],
            'total' => [
                'type' => Type::int(),
                'description' => 'The total'
            ]
        ];
    }
}
