<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class DayClosureType extends BaseType
{
   
    protected $attributes = [
        'name' => 'DayClosureType',
        'description' => 'DayClosure type.'
    ];
    
    public function fields()
    {
        return [
            'gastos' => [
                'type' => Type::listOf(GraphQL::type('ExpenseType'))
            ],
            'pagos' => [
                'type' => Type::listOf(GraphQL::type('PaymentEmployeeType'))
            ],
            'ventas' => [
                'type' => Type::listOf(GraphQL::type('SalesType'))
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
            'restante' => [
                'type' => Type::string()
            ],
            'is_closure'=> [
                'type' => Type::boolean()
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

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->toDateTimeString();
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at->toDateTimeString();
    }
}