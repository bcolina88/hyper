<?php

namespace App\GraphQL\Mutation\Payment;

use GraphQL;
use App\Models\Payment;
use App\Models\RideHasPayment;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;


class DeletePaymentMutation extends Mutation {

    protected $attributes = [
        'name' => 'deletePayment',
        'description' => 'Delete a payment.'

    ];

    public function type()
    {
        return GraphQL::type('Payment');
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


        if( $payment = Payment::findOrFail($args['id']) ) {


            $rideHasPayment = RideHasPayment::where('payment_id',$payment->id)->first();
            $rideHasPayment->delete();
            $payment->delete();
            return $payment;
        }
        return null;
    }

}