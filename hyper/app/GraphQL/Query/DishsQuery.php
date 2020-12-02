<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Dish;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\Storage;

class DishsQuery extends Query {

    protected $attributes = [
        'name' => 'Dishs',
        'description' => 'Dishs list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('DishType'));
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
       
        $dishs = Dish::all();

        foreach ($dishs as  $value) {
            $value['image'] = env('APP_URL').$value['image'];
        }



        return $dishs;
    }
}