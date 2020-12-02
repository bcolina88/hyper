<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Closure;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class ClosuresQuery extends Query {

    protected $attributes = [
        'name' => 'Closures',
        'description' => 'Closures list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('ClosureType'));
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
       
        $closures = Closure::all();
        return $closures;
    }
}