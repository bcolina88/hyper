<?php

namespace App\GraphQL\Mutation\Payment;


use GraphQL;
use App\Models\Payment;
use App\Models\Ride;
use App\Models\RideHasPayment;
use App\Models\BankAccount;
use App\Models\CurrencyRate;
use App\Models\Bank;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;


class CreatePaymentMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreatePayment',
        'description' => 'Create a new payment.'
    ];

    public function type()
    {
        return GraphQL::type('Payment');
    }

    public function args()
    {
        return [
            'ride' => [
                'type' => Type::nonNull(Type::id()),
                'rules' => ['required']
            ],
            'amount' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
            'reference' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'comment' => [
                'type' => Type::string()
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'bankAccount' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
            'createdBy' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
            'updatedBy' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
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
            'amount'    => $args['amount'],
            'reference' => $args['reference'],
            'comment'   => $args['comment'],
            'type'      => $args['type'],
            'bankAccount_id' => $args['bankAccount'],
            'createdBy_id'=> $args['createdBy'],
            'updatedBy_id'=> $args['updatedBy']
        ];


        //Actualizar pago
        $bankAccount = BankAccount::find($args['bankAccount']);
        $bankId = $bankAccount->bank_id;
        $bank = Bank::where('id',$bankId)->get();;
        $currency = $bank[0]->currency_id;


        $rate = CurrencyRate::where('currency_id',$currency)->get();
        $paso1 = $args['amount'] / $rate[0]->value;
        $ride = Ride::find($args['ride']);


        $ride->update([
            'totalPaid' => $ride->totalPaid + $paso1,
            'pendingPayment'  => $ride->pendingPayment - $paso1,
            'payment' => 1,
        ]);


        $bankAccount->update([
            'currentBalance'  => $bankAccount->currentBalance + $args['amount'],
        ]);


        //Fin actualizar pago

        $payment = Payment::create($data);


        $data1= [
            'ride_id'             => $args['ride'],
            'payment_id'          => $payment->id,
        ];

        $rideHasPayment = RideHasPayment::create($data1);

        return $payment;


    }
}
