<?php

namespace App\GraphQL\Mutation\Sale;

use GraphQL;
use App\Models\Sales;
use App\Models\SalesItems;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteSaleMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteSale',
        'description' => 'Delete a Sale.'

    ];

    public function type()
    {
        return GraphQL::type('SalesType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
   
        
        if( $sales = Sales::findOrFail($args['id']) ) {
            
            $salesItems = SalesItems::where('sales_id',$args['id'])->get();

            foreach ($salesItems as $key => $item) {

                SalesItems::destroy($item['id']);  
            }

            Sales::destroy($args['id']);
            return $sales;

        }

        return null;

    }

}