<?php

namespace App\GraphQL\Mutation\Sale;

use GraphQL;
use App\Models\Sales;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class BlockedSaleMutation extends Mutation {

    protected $attributes = [
        'name' => 'blockedSale',
        'description' => 'Blocked a sale.'

    ];

    public function type()
    {
        return GraphQL::type('SalesType');
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
        
       
        $sale = Sales::find($args['id']);
   
        if($sale) {
            
            $sale->status = $args['status'];
            $sale->save();
            return $sale;
        }
        
        return null;
    }

}