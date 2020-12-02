<?php

namespace App\GraphQL\Mutation\Boxe;

use GraphQL;
use App\Models\Boxe;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Carbon\Carbon;



class CreateBoxeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateBoxe',
        'description' => 'Create a new boxe.'
    ];

    public function type()
    {
        return GraphQL::type('BoxeType');
    }

    public function args()
    {
        return [
            'descripcion' => [
                'type' => Type::string(),
            ],
            'tipo' => [
                'type' => Type::string(),
            ],
            'monto' => [
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
        $date = Carbon::now();
        $date = $date->format('d-m-Y');

        $data = [
            'descripcion' => $args['descripcion'],
            'tipo' => $args['tipo'],
            'monto' => $args['monto'],
            'fecha' => $date,

        ];

        $boxe = Boxe::create($data);

        return $boxe;


    }
}
