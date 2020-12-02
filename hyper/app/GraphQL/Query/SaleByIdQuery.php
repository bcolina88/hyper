<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Sales;
use App\Models\SalesItems;

class SaleByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'SaleByIdQuery',
        'description' => 'Find an sale.'
    ];

    public function type()
    {
       // return GraphQL::type('SalesType');
        return Type::listOf(GraphQL::type('SalesItemsType'));
        

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

        
        $salesItems = SalesItems::where('sales_id',$args['id'])->get();
        return $salesItems;

        //return Sales::find($args['id']);

    }
}
