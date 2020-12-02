<?php

namespace App\GraphQL\Mutation\Dish;

use GraphQL;
use App\Models\Dish;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;


class BlockedDishMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteDish',
        'description' => 'Blocked a dish.'

    ];

    public function type()
    {
        return GraphQL::type('DishType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::boolean())]
        ];
    }

    public function resolve($root, $args)
    {
        

        $dish = Dish::find($args['id']);
   
        if($dish) {
            
            $dish->active = $args['status'];
            $dish->save();

            return $dish;
        }

       
        return null;
    }

}