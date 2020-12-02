<?php

namespace App\GraphQL\Mutation\Dish;

use GraphQL;
use App\Models\Dish;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateDishMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateDish',
        'description' => 'Update a dish.'

    ];

    public function type()
    {
        return GraphQL::type('DishType');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => [ 'type' => Type::string()],
            'price' => [ 'type' => Type::string()],
            'code' => [ 'type' => Type::string()],
            'preparation' => [ 'type' => Type::string()],
            'description' => [ 'type' => Type::string()],
            'unity' => [ 'type' => Type::string()],
            'duration' => [ 'type' => Type::string()],
            'category' => [ 'type' => Type::id()],
            'stock' => ['type' => Type::int()],
            'stock_min' => ['type' => Type::int()]
        ];
    }



    public function resolve($root, $args)
    {
        

        $dish = Dish::find($args['id']);

        if(!$dish)
        {
            return null;
        }

        // update dish        
        $dish->update([
            'name'   => $args['name'],
            'price'   => $args['price'],
            'code' => $args['code'],
            'preparation' => $args['preparation'],
            'description' => $args['description'],
            'unity' => $args['unity'],
            'duration' => $args['duration'],
            'category_id' => $args['category'],
            'stock' => $args['stock'],
            'stock_min' => $args['stock_min'],
        ]);
       
        return $dish;


    }

}