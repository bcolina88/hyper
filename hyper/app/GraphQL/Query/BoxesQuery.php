<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Boxe;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class BoxesQuery extends Query {

    protected $attributes = [
        'name' => 'Boxes',
        'description' => 'Boxes list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('BoxeType'));
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
       
        $boxes = Boxe::all();
        return $boxes;
    }
}