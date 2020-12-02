<?php

namespace App\GraphQL\Mutation\Table;

use GraphQL;
use App\Models\Table;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteTableMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteTable',
        'description' => 'Delete a table.'

    ];

    public function type()
    {
        return GraphQL::type('TableType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
   
        
        if( $table = Table::findOrFail($args['id']) ) {
            $table->delete();
            return $table;
        }
        return null;
    }

}