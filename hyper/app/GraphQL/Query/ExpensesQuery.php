<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Expense;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class ExpensesQuery extends Query {

    protected $attributes = [
        'name' => 'expenses',
        'description' => 'Expenses list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('ExpenseType'));
    }

    public function args()
    {
        
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/
       
        $expenses = Expense::all();
        return $expenses;
    }
}