<?php

namespace App\GraphQL\Mutation\Category;

use GraphQL;
use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateCategoryMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateCategory',
        'description' => 'Update a category.'

    ];

    public function type()
    {
        return GraphQL::type('CategoryType');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => [ 'type' => Type::string()],
            
        ];
    }



    public function resolve($root, $args)
    {
        

        $existencia = Category::where('name', $args['name'])->exists();
        $category = Category::find($args['id']);


        if(!$category)
        {
            return null;
        }


        if (!$existencia){

            // update category
            $category->update([
                'name' => $args['name'],
            ]);

            return $category;

        }else{

            if (strcmp($args['name'], $category->name) == 0) {

                if ($existencia){

                    // update category
                    $category->update([
                        'name' => $args['name'],
                    ]);

                    return $category;
                }
            }
        }

        throw new \Exception("validation");

    }

}