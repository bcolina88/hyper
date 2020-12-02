<?php

namespace App\GraphQL\Mutation\Sale;


use GraphQL;
use App\Models\Sales;
use App\Models\PaymentSale;
use App\Models\Table;
use App\Models\SalesItems;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\InputObjectType;
use Carbon\Carbon;



class PagarSaleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'pagarSale',
        'description' => 'Pagar a sale.'
    ];

    public function type()
    {
        return GraphQL::type('PaymentSaleType');
    }

    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id())
            ],
            'efectivo' => [
                'type' => Type::string(),
            ],
            'debito' => [
                'type' => Type::string(),
            ],
            'cheque' => [
                'type' => Type::string(),
            ],
            'transferencia' => [
                'type' => Type::string(),
            ],
            'otros' => [
                'type' => Type::string(),
            ],
            'currency' => [
                'type' => Type::nonNull(Type::id())
            ],


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

        $date = Carbon::now();
        $date = $date->format('d-m-Y');


        $sale = Sales::find($args['id']);
        $table = Table::where('id',$sale->table_id)->first();


        if(!$sale)
        {
            return null;
        }

        //Pago

        $data = [
            'sale_id'        => $args['id'],
            'currency_id'    => $args['currency'],
            'efectivo'       => $args['efectivo'],
            'debito'         => $args['debito'],
            'cheque'         => $args['cheque'],
            'transferencia'  => $args['transferencia'],
            'otros'          => $args['otros'],
        ];

        $paymentSale = PaymentSale::create($data);

        $sale->fill([
             'status' => 0,
        ]);

        $sale->save();

        $table->status = 1;
        $table->save();


        return $paymentSale;
    
    }
}
