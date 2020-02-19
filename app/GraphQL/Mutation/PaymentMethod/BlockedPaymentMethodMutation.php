<?php

namespace App\GraphQL\Mutation\PaymentMethod;

use GraphQL;
use App\Models\PaymentMethod;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class BlockedPaymentMethodMutation extends Mutation {

    protected $attributes = [
        'name' => 'blockedPaymentMethod',
        'description' => 'Blocked a payment method.'

    ];

    public function type()
    {
        return GraphQL::type('PaymentMethod');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::int())]
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

        $payment = PaymentMethod::find($args['id']);

        if($payment) {

            $payment->active = $args['status'];
            $payment->save();
            return $payment;
        }


        return null;
    }

}