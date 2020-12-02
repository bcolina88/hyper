<?php

namespace App\GraphQL\Mutation\PaymentEmployee;

use GraphQL;
use App\Models\PaymentEmployee;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class DeletePaymentEmployeeMutation extends Mutation {

    protected $attributes = [
        'name' => 'deletePaymentEmployee',
        'description' => 'Delete a payment employee.'

    ];

    public function type()
    {
        return GraphQL::type('PaymentEmployeeType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {

        if( $payment = PaymentEmployee::findOrFail($args['id']) ) {
            $payment->delete();
            return $payment;
        }
        return null;
    }

}