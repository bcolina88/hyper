<?php

namespace App\GraphQL\Mutation\Boxe;

use GraphQL;
use App\Models\Boxe;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateBoxeMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateBoxe',
        'description' => 'Update a boxe.'

    ];

    public function type()
    {
        return GraphQL::type('BoxeType');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'descripcion' => [ 'type' => Type::string()],
            'tipo' => [ 'type' => Type::string()],
            'monto' => [ 'type' => Type::string()],
           
        ];
    }



    public function resolve($root, $args)
    {
        

        $boxe = Boxe::find($args['id']);

        if(!$boxe)
        {
            return null;
        }

        // update boxe        
        $boxe->update([
            'descripcion'   => $args['descripcion'],
            'tipo'   => $args['tipo'],
            'monto' => $args['monto'],
            
        ]);
       
        return $boxe;


    }

}