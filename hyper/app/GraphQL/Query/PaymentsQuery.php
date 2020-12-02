<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\PaymentEmployee;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class PaymentsQuery extends Query {

    protected $attributes = [
        'name' => 'payments',
        'description' => 'Payments list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('PaymentEmployeeType'));
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
       
        $payment = PaymentEmployee::all();
        return $payment;
    }
}