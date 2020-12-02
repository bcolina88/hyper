<?php

namespace App\GraphQL\Mutation\Boxe;

use GraphQL;
use App\Models\Boxe;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteBoxeMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteBoxe',
        'description' => 'Delete a boxe.'

    ];

    public function type()
    {
        return GraphQL::type('BoxeType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
   
        
        if( $boxe = Boxe::findOrFail($args['id']) ) {
            $boxe->delete();
            return $boxe;
        }
        return null;
    }

}