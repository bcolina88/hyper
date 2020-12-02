<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Boxe;

class BoxeByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'BoxeByIdQuery',
        'description' => 'Find an boxe.'
    ];

    public function type()
    {
        return GraphQL::type('BoxeType');
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

        
        return Boxe::find($args['id']);

    }
}
