<?php

namespace App\GraphQL\Mutation\PaymentMethodHasBank;

use GraphQL;
use App\Models\PaymentMethodHasBank;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;


class DeletePaymentMethodHasBankMutation extends Mutation {

    protected $attributes = [
        'name' => 'deletePaymentMethodHasBank',
        'description' => 'Delete a paymentMethodHasBank.'

    ];

    public function type()
    {
        return GraphQL::type('PaymentMethodHasBank');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        if( $paymentMethodHasBank = PaymentMethodHasBank::findOrFail($args['id']) ) {
            $paymentMethodHasBank->delete();
            return $paymentMethodHasBank;
        }
        return null;
    }

}