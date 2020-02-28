<?php

namespace App\GraphQL\Mutation\PaymentMethod;

use GraphQL;
use App\Models\PaymentMethod;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdatePaymentMethodMutation extends Mutation {

    protected $attributes = [
        'name' => 'updatePaymentMethod',
        'description' => 'Update a payment method.'

    ];

    public function type()
    {
        return GraphQL::type('PaymentMethod');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::id())],
            'method' => ['type' => Type::string()],
            'name' => ['type' => Type::string()],
            'rif' => ['type' => Type::string()],
            'phone' => ['type' => Type::string()]
   

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

        if(!$payment)
        {
            return null;
        }

        // update payment
        $payment->update([
            'method'    => $args['method'],
            'name'      => $args['name'],
            'rif'       => $args['rif'],
            'phone'     => $args['phone']
        ]);

        return $payment;
    }

}