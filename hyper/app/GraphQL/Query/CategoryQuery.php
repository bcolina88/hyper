<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Category;

class CategoryQuery extends Query
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'Find an category.'
    ];

    public function type()
    {
        return GraphQL::type('CategoryType');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
        return Category::find($args['id']);

    }
}
