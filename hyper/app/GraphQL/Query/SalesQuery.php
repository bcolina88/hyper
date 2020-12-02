<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Sales;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class SalesQuery extends Query {

    protected $attributes = [
        'name' => 'sales',
        'description' => 'Sales list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('SalesType'));
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

        $sales = Sales::orderBy('id','DESC')->get();
        return $sales;
    }
}