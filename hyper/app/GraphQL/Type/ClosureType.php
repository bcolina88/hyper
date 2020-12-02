<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class ClosureType extends BaseType
{
   
    protected $attributes = [
        'name' => 'ClosureType',
        'description' => 'Closure type.'
    ];
    
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'fecha' => [
                'type' => Type::nonNull(Type::string())
            ],
            'total_efectivo' => [
                'type' => Type::nonNull(Type::string())
            ],
            'total_debito' => [
                'type' => Type::nonNull(Type::string())
            ],
            'total_cheque' => [
                'type' => Type::nonNull(Type::string())
            ],
            'total_transferencia' => [
                'type' => Type::nonNull(Type::string())
            ],
            'total_otros' => [
                'type' => Type::nonNull(Type::string())
            ],
            'total_ventas' => [
                'type' => Type::nonNull(Type::string())
            ],
            'total_pago' => [
                'type' => Type::nonNull(Type::string())
            ],
            'total_gastos' => [
                'type' => Type::nonNull(Type::string())
            ],
            'caja_apertura' => [
                'type' => Type::nonNull(Type::string())
            ],
            'caja_cierre' => [
                'type' => Type::nonNull(Type::string())
            ],
            'restante' => [
                'type' => Type::nonNull(Type::string())
            ],
            'notas' => [
                'type' => Type::nonNull(Type::string())
            ],
            'retiro' => [
                'type' => Type::nonNull(Type::int())
            ],
            'total_cuadre' => [
                'type' => Type::nonNull(Type::int())
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->toDateTimeString();
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at->toDateTimeString();
    }
}