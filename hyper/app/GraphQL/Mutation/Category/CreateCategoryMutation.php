<?php

namespace App\GraphQL\Mutation\Category;


use GraphQL;
use App\Models\Category;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;


class CreateCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateCategory',
        'description' => 'Create a new category.'
    ];

    public function type()
    {
        return GraphQL::type('CategoryType');
    }

    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required','unique:categorys']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $data = [
            'name' => $args['name'],
            'active'=> 1,
            
        ];

        $category = Category::create($data);

        return $category;


    }
}
