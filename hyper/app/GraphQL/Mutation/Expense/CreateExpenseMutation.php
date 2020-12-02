<?php

namespace App\GraphQL\Mutation\Expense;

use GraphQL;
use App\Models\Expense;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Carbon\Carbon;



class CreateExpenseMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateExpense',
        'description' => 'Create a new expense.'
    ];

    public function type()
    {
        return GraphQL::type('ExpenseType');
    }

    public function args()
    {
        return [
            'nombre' => [
                'type' => Type::string(),
            ],
            'metodo_pago' => [
                'type' => Type::string(),
            ],
            'monto' => [
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
        $date = Carbon::now();
        $date = $date->format('d-m-Y');

        $data = [
            'nombre' => $args['nombre'],
            'metodo_pago' => $args['metodo_pago'],
            'monto' => $args['monto'],
            'fecha' => $date,

        ];

        $expense = Expense::create($data);

        return $expense;


    }
}
