<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Expense;

class ExpenseByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'ExpenseByIdQuery',
        'description' => 'Find an expense.'
    ];

    public function type()
    {
        return GraphQL::type('ExpenseType');
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

    public function resolve($root, $args)
    {

        
        return Expense::find($args['id']);

    }
}
