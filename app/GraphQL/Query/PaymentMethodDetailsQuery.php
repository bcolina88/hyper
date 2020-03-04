<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodHasBank;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class PaymentMethodDetailsQuery extends Query
{
    protected $attributes = [
        'name' => 'driverDetails',
        'description' => 'Driver Details.'
    ];

    public function type()
    {
        return GraphQL::type('PaymentMethodHasBankDetails');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
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

        $bank_account =[];

        $paymentMethod = PaymentMethod::where('id',$args['id'])->first();

        $PaymentMethodHasBank = PaymentMethodHasBank::where('paymentMethod_id',$paymentMethod->id)->get();

        foreach ($PaymentMethodHasBank as $key => $value) {
            # code...

            array_push($bank_account, $value->bankAccount);
        }

        $paymentMethod['bank_account']=$bank_account;

        return $paymentMethod;


    }
}
