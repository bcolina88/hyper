<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Role;

class RoleByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'RoleById',
        'description' => 'Find an role.'
    ];

    public function type()
    {
        return GraphQL::type('RoleType');
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

    public function resolve($root, $args)
    {

        
        return Role::find($args['id']);

    }
}
