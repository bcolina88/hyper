<?php

namespace App\GraphQL\Mutation\PaymentMethodHasBank;

use GraphQL;
use App\Models\PaymentMethodHasBank;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;


class CreatePaymentMethodHasBankMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreatePaymentMethodHasBank',
        'description' => 'Create a new PaymentMethodHasBank.'
    ];

    public function type()
    {
        return GraphQL::type('PaymentMethodHasBank');
    }

    public function args()
    {
        return [
            'bankAccount' => [
                'type' => Type::nonNull(Type::id())
            ],
            'paymentMethod' => [
                'type' => Type::nonNull(Type::id())
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/
        

        $data = [
            'paymentMethod_id'   => $args['paymentMethod'],
            'bankAccount_id'      => $args['bankAccount']
        ];

        $paymentMethodHasBank = PaymentMethodHasBank::create($data);

        return $paymentMethodHasBank;

    }
}
