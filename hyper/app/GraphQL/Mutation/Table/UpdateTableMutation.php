<?php

namespace App\GraphQL\Mutation\Table;

use GraphQL;
use App\Models\Table;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateTableMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateTable',
        'description' => 'Update a table.'

    ];

    public function type()
    {
        return GraphQL::type('TableType');
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
        

        $existencia = Table::where('name', $args['name'])->exists();
        $table = Table::find($args['id']);


        if(!$table)
        {
            return null;
        }


        if (!$existencia){

            // update table
            $table->update([
                'name' => $args['name'],
            ]);

            return $table;

        }else{

            if (strcmp($args['name'], $table->name) == 0) {

                if ($existencia){

                    // update table
                    $table->update([
                        'name' => $args['name'],
                    ]);

                    return $table;
                }
            }
        }

        throw new \Exception("validation");

    }

}