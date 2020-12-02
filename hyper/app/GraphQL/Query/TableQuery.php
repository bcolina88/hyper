<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Table;

class TableQuery extends Query
{
    protected $attributes = [
        'name' => 'Table',
        'description' => 'Find an table.'
    ];

    public function type()
    {
        return GraphQL::type('TableType');
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
        
        return Table::find($args['id']);

    }
}
