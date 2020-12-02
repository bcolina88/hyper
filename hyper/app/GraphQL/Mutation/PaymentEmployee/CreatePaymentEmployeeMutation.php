<?php

namespace App\GraphQL\Mutation\PaymentEmployee;

use GraphQL;
use App\Models\PaymentEmployee;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\InputObjectType;
use Carbon\Carbon;



class CreatePaymentEmployeeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createPaymentEmployee',
        'description' => 'Create a new payment employee.'
    ];

    public function type()
    {
        return GraphQL::type('PaymentEmployeeType');
    }

    public function args()
    {
        return [
            'payments' => [
                'name' => 'payments', 
                'type' => Type::listOf(new InputObjectType([
                    'name' => 'employees',
                    'fields' => [ 
                        'sueldo_diario'   => ['name' => 'sueldo_diario', 'type' => Type::string()],
                        'id'    => ['name' => 'id', 'type' => Type::id()],    
                    ]
                ]))
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
        $date = Carbon::now();
        $date = $date->format('d-m-Y');



        $payments = $args['payments'];


        foreach ($payments as $key => $item) {
           
           $payment = new PaymentEmployee;
           $payment->employee_id    = $item['id'];
           $payment->sueldo_diario  = $item['sueldo_diario'];
           $payment->fecha          = $date;
           $payment->save();
          
        }

        return $payment;


    }
}
