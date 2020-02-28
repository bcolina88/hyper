<?php

namespace App\GraphQL\Mutation\PaymentMethodHasBank;

use GraphQL;
use App\Models\PaymentMethodHasBank;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;


class UpdatePaymentMethodHasBankMutation extends Mutation {

    protected $attributes = [
        'name' => 'updatePaymentMethodHasBank',
        'description' => 'Update a PaymentMethodHasBank.'

    ];

    public function type()
    {
        return GraphQL::type('PaymentMethodHasBank');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'bankAccount' => [ 'type' => Type::id()],
            'paymentMethod' => [ 'type' => Type::id()],
           
           
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
          
        $paymentMethodHasBank = PaymentMethodHasBank::find($args['id']);

        if(!$paymentMethodHasBank)
        {
            return null;
        }

        // update paymentMethodHasBank
        $paymentMethodHasBank->update([
            'bankAccount_id'      => $args['bankAccount'],
            'paymentMethod_id'  => $args['paymentMethod'],
        ]);

        return $paymentMethodHasBank;

        
    }

}