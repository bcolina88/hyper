<?php

namespace App\GraphQL\Mutation\Closure;

use GraphQL;
use App\Models\Closure;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Carbon\Carbon;

class CreateClosureMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateClosure',
        'description' => 'Create a new closure.'
    ];

    public function type()
    {
        return GraphQL::type('ClosureType');
    }

    public function args()
    {
        return [
            'fecha' => [
                'type' => Type::string()
            ],
            'total_efectivo' => [
                'type' => Type::string()
            ],
            'total_debito' => [
                'type' => Type::string()
            ],
            'total_cheque' => [
                'type' => Type::string()
            ],
            'total_transferencia' => [
                'type' => Type::string()
            ],
            'total_otros' => [
                'type' => Type::string()
            ],
            'total_ventas' => [
                'type' => Type::string()
            ],
            'total_pago' => [
                'type' => Type::string()
            ],
            'total_gastos' => [
                'type' => Type::string()
            ],
            'caja_apertura' => [
                'type' => Type::string()
            ],
            'caja_cierre' => [
                'type' => Type::string()
            ],
            'notas' => [
                'type' => Type::string()
            ], 
            'retiro' => [
                'type' => Type::string()
            ], 
            'total_cuadre' => [
                'type' => Type::string()
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

        $data = [
            'fecha'               => $date,
            'total_efectivo'      => $args['total_efectivo'],
            'total_debito'        => $args['total_debito'],
            'total_cheque'        => $args['total_cheque'],
            'total_transferencia' => $args['total_transferencia'],
            'total_otros'         => $args['total_otros'],
            'total_ventas'        => $args['total_ventas'],
            'total_pago'          => $args['total_pago'],
            'total_gastos'        => $args['total_gastos'],
            'caja_apertura'       => $args['caja_apertura'],
            'caja_cierre'         => $args['caja_cierre'],            
            'total_cuadre'        => $args['total_cuadre'],            
            'retiro'              => $args['retiro'],            
            'notas'               => $args['notas'],            
        ];

        $closure = Closure::create($data);

        return $closure;


    }
}
