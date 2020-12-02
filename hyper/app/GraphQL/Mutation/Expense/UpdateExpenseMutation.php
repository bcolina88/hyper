<?php

namespace App\GraphQL\Mutation\Expense;

use GraphQL;
use App\Models\Expense;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateExpenseMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateExpense',
        'description' => 'Update a expense.'

    ];

    public function type()
    {
        return GraphQL::type('ExpenseType');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'nombre' => [ 'type' => Type::string()],
            'metodo_pago' => [ 'type' => Type::string()],
            'monto' => [ 'type' => Type::string()],
           
        ];
    }



    public function resolve($root, $args)
    {
        

        $expense = Expense::find($args['id']);

        if(!$expense)
        {
            return null;
        }

        // update expense        
        $expense->update([
            'nombre'   => $args['nombre'],
            'metodo_pago'   => $args['metodo_pago'],
            'monto' => $args['monto'],
            
        ]);
       
        return $expense;


    }

}