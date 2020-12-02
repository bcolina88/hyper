<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Table;
use App\Models\Sales;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class TablesQuery extends Query {

    protected $attributes = [
        'name' => 'Tables',
        'description' => 'Tables list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('TableSaleType'));
    }

    public function args()
    {
        
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $results = [];
        $tables = Table::all();


        foreach ($tables as $key => $item) {

            $itemSale = Sales::where('table_id',$item->id)->where('status',1)->first();

            if ($itemSale) {
                $salesTable = array('id' => $item->id,'name' => $item->name,'status' => $item->status,'active' =>$item->active,'sale' => $itemSale->id);
            }else{
                $salesTable = array('id' => $item->id,'name' => $item->name,'status' => $item->status,'active' =>$item->active,'sale' => 0);

            }
            
            array_push($results,$salesTable);

         }


        
        return  $results;

        //return $tables;
    }
}