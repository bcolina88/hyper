<?php

namespace App\GraphQL\Mutation\Closure;

use GraphQL;
use App\Models\Closure;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteClosureMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteClosure',
        'description' => 'Delete a closure.'

    ];

    public function type()
    {
        return GraphQL::type('ClosureType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
   
        
        if( $closure = Closure::findOrFail($args['id']) ) {
            $closure->delete();
            return $closure;
        }
        return null;
    }

}