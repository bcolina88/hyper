<?php

namespace App\GraphQL\Mutation\Expense;

use GraphQL;
use App\Models\Expense;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteExpenseMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteExpense',
        'description' => 'Delete a expense.'

    ];

    public function type()
    {
        return GraphQL::type('ExpenseType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
   
        
        if( $expense = Expense::findOrFail($args['id']) ) {
            $expense->delete();
            return $expense;
        }
        return null;
    }

}