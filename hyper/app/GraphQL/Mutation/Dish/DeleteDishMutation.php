<?php

namespace App\GraphQL\Mutation\Dish;

use GraphQL;
use App\Models\Dish;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteDishMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteCategory',
        'description' => 'Delete a dish.'

    ];

    public function type()
    {
        return GraphQL::type('DishType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
   
        
        if( $dish = Dish::findOrFail($args['id']) ) {
            $dish->delete();
            return $dish;
        }
        return null;
    }

}