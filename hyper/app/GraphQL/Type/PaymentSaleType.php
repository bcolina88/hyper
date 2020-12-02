<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class PaymentSaleType extends BaseType
{
   
     protected $attributes = [
        'name' => 'PaymentSaleType',
        'description' => 'Payment Sale type'
    ];



    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'sale' => [
                'type' => Type::nonNull(GraphQL::type('SalesType'))
            ],
            'currency' => [
                'type' => Type::nonNull(GraphQL::type('CurrencyType'))
            ],
            'efectivo' => [
                'type' => Type::nonNull(Type::string())
            ],
            'debito' => [
                'type' => Type::nonNull(Type::string())
            ],
            'cheque' => [
                'type' => Type::nonNull(Type::string())
            ],
            'transferencia' => [
                'type' => Type::nonNull(Type::string())
            ],
            'otros' => [
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