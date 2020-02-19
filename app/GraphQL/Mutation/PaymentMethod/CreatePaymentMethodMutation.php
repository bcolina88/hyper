<?php

namespace App\GraphQL\Mutation\PaymentMethod;


use GraphQL;
use App\Models\PaymentMethod;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;


class CreatePaymentMethodMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreatePaymentMethod',
        'description' => 'Create a new payment method.'
    ];

    public function type()
    {
        return GraphQL::type('PaymentMethod');
    }

    public function args()
    {
        return [
            'method' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'rif' => [
                'type' =>Type::string()
            ],
            'phone' => [
                'type' => Type::string()
            ],
            'bank' => [
                'type' => Type::int()
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
            'method'    => $args['method'],
            'name'      => $args['name'],
            'rif'       => $args['rif'],
            'phone'     => $args['phone'],
            'bank_id'   => $args['bank'],
            'active'    => 1

        ];

        $payment = PaymentMethod::create($data);

        return $payment;


    }
}
