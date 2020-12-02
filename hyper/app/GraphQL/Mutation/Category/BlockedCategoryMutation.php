<?php

namespace App\GraphQL\Mutation\Category;

use GraphQL;
use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class BlockedCategoryMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteCategory',
        'description' => 'Blocked a category.'

    ];

    public function type()
    {
        return GraphQL::type('CategoryType');
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
        
       
        $category = Category::find($args['id']);
   
        if($category) {
            
            $category->active = $args['status'];
            $category->save();
            return $category;
        }
        
        return null;
    }

}