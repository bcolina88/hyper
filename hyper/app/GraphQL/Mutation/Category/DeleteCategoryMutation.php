<?php

namespace App\GraphQL\Mutation\Category;

use GraphQL;
use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteCategoryMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteCategory',
        'description' => 'Delete a category.'

    ];

    public function type()
    {
        return GraphQL::type('CategoryType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
   
        
        if( $category = Category::findOrFail($args['id']) ) {
            $category->delete();
            return $category;
        }
        return null;
    }

}