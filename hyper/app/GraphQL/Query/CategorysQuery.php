<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class CategorysQuery extends Query {

    protected $attributes = [
        'name' => 'categorys',
        'description' => 'Categorys list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('CategoryType'));
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
       
        $categorys = Category::all();
        return $categorys;
    }
}