<?php

namespace App\GraphQL\Mutation\Payment;

use GraphQL;
use App\Models\Payment;
use App\Models\RideHasPayment;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdatePaymentMutation extends Mutation {

    protected $attributes = [
        'name' => 'updatePayment',
        'description' => 'Update a payment.'

    ];

    public function type()
    {
        return GraphQL::type('Payment');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'ride' => ['type' => Type::id()],
            'amount' => ['type' => Type::float()],
            'reference' => ['type' => Type::string()],
            'comment' => ['type' => Type::string()],
            'type' => ['type' => Type::string()],
            'bankAccount' => ['type' => Type::int()],
            'updatedBy' => [ 'type' => Type::int()]

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


        $payment = Payment::find($args['id']);

        if(!$payment)
        {
            return null;
        }

        // update payment
        $payment->update([
            'amount'    => $args['amount'],
            'reference' => $args['reference'],
            'comment'   => $args['comment'],
            'type'      => $args['type'],
            'bankAccount_id' => $args['bankAccount'],
            'updatedBy_id'=> $args['updatedBy']
        ]);


        $rideHasPayment = RideHasPayment::where('payment_id',$payment->id)->first();

        // update rideHasPayment
        $rideHasPayment->update([
            'ride_id'  => $args['ride'],
            'payment_id'  => $payment->id,
        ]);

        return $payment;
    }

}