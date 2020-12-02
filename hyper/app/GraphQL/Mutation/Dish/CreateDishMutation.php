<?php

namespace App\GraphQL\Mutation\Dish;

use GraphQL;
use App\Models\Dish;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;


class CreateDishMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateDish',
        'description' => 'Create a new dish.'
    ];

    public function type()
    {
        return GraphQL::type('DishType');
    }

    public function args()
    {
        return [
            'name' => [
                'type' => Type::string(),
            ],
            'price' => [
                'type' => Type::string(),
            ],
            'code' => [
                'type' => Type::string(),
            ],
            'preparation' => [
                'type' => Type::string(),
            ],
            'description' => [
                'type' => Type::string(),
            ],
            'image' => [
                'type' => Type::string(),
            ],
            'unity' => [
                'type' => Type::string(),
            ],
            'duration' => [
                'type' => Type::string(),
            ],
            'category' => [
                'type' => Type::id(),
            ],
            'stock' => [
                'type' => Type::int(),
            ],
            'stock_min' => [
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
     
        /*if ($args['preparation'] === '') {
            $preparation = NULL;
        }else{
            $preparation = $args['preparation'];
        }

        if ($args['description'] === '') {
            $description = NULL;
        }else{
            $description = $args['description'];
        }

        if ($args['unity'] === '') {
            $unity = NULL;
        }else{
            $unity = $args['unity'];
        }

        if ($args['duration'] === '') {
            $duration = NULL;
        }else{
            $duration = $args['duration'];
        }*/


        $data = [
            'name' => $args['name'],
            'price' => $args['price'],
            'code' => $args['code'],
            'preparation' => $args['preparation'],
            'description' => $args['description'],
            'unity' => $args['unity'],
            'image' => $args['image'],
            'duration' => $args['duration'],
            'category_id' => $args['category'],
            'active' => 1,
            'stock' => $args['stock'],
            'stock_min' => $args['stock_min'],
        ];

        $dish = Dish::create($data);

        return $dish;


    }
}
