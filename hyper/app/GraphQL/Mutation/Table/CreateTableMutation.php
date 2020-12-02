<?php

namespace App\GraphQL\Mutation\Table;

use GraphQL;
use App\Models\Table;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;


class CreateTableMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateTable',
        'description' => 'Create a new table.'
    ];

    public function type()
    {
        return GraphQL::type('TableType');
    }

    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required','unique:tables']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        

        $data = [
            'name' => $args['name'],
            'active' => 1,
            'status' => 1
        ];

        $table = Table::create($data);

        return $table;


    }
}
