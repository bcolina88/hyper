<?php

namespace App\GraphQL\Mutation\Sale;


use GraphQL;
use App\Models\Sales;
use App\Models\Table;
use App\Models\SalesItems;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\InputObjectType;
use Carbon\Carbon;



class CreateSaleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateSale',
        'description' => 'Create a new sale.'
    ];

    public function type()
    {
        return GraphQL::type('SalesType');
    }

    public function args()
    {
        return [
            'products' => [
                'name' => 'products', 
                 'type' => Type::listOf(new InputObjectType([
                    'name' => 'prod',
                    'fields' => [ 
                        'price'    => ['name' => 'price', 'type' => Type::string()],
                        'name'     => ['name' => 'name', 'type' => Type::string()],
                        'category' => ['name' => 'category', 'type' => Type::string()],
                        'quantity' => ['name' => 'quantity', 'type' => Type::id()],   
                        'id'       => ['name' => 'id', 'type' => Type::id()],    
                    ]
                ]))
            ],
            'numberPeople' => [
                'type' => Type::int(),
            ],
            'observation' => [
                'type' => Type::string(),
            ],
            'total' => [
                'type' => Type::string(),
            ],
            'table' => [
                'type' => Type::id(),
            ],
            'waiter' => [
                'type' => Type::id(),
            ]


        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $arti = [];
        $canti = [];
        $eliminar = [];
        $date = Carbon::now();
        $date = $date->format('d-m-Y');


        $data = [
             'status'         => 1,
             'date'           => $date,
             'numberPeople'   => $args['numberPeople'], 
             'observation'    => $args['observation'],
             'total'          => $args['total'], 
             'table_id'       => $args['table'], 
             'waiter_id'      => $args['waiter'],
        ];

        $sale = Sales::create($data);

        $products = $args['products'];


        foreach ($products as $key => $item) {

           $salesItems = new SalesItems;
           $salesItems->sales_id   = $sale->id;
           $salesItems->dish_id    = $item['id'];
           $salesItems->price      = $item['price'];
           $salesItems->total      = $item['price'] * $item['quantity'];
           $salesItems->quantity   = $item['quantity'];
           $salesItems->date       = $date;
           $salesItems->save();
          
        }

        $table = Table::where('id',$args['table'])->first();
        $table->status = 0;
        $table->save();



        return $sale;


    }
}
