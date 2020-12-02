<?php

namespace App\GraphQL\Mutation\Table;

use GraphQL;
use App\Models\Table;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;


class BlockedTableMutation extends Mutation {

    protected $attributes = [
        'name' => 'BlockedTable',
        'description' => 'Blocked a table.'

    ];

    public function type()
    {
        return GraphQL::type('TableType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::boolean())]
        ];
    }

    public function resolve($root, $args)
    {
        

        $table = Table::find($args['id']);
   
        if($table) {
            
            $table->active = $args['status'];
            $table->save();

            return $table;
        }

       
        return null;
    }

}