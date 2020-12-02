<?php

namespace App\GraphQL\Mutation\Employee;

use GraphQL;
use App\Models\Employee;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Carbon\Carbon;



class CreateEmployeeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateEmployee',
        'description' => 'Create a new employee.'
    ];

    public function type()
    {
        return GraphQL::type('EmployeeType');
    }

    public function args()
    {
        return [
            'rut' => [
                'type' => Type::string(),
            ],
            'nombre' => [
                'type' => Type::string(),
            ],
            'apellido' => [
                'type' => Type::string(),
            ],
            'telefono' => [
                'type' => Type::string(),
            ],
            'sueldo_mensual' => [
                'type' => Type::string(),
            ],
            'sueldo_diario' => [
                'type' => Type::string(),
            ],
            'role' => ['type' => Type::id()],

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
        $date = Carbon::now();
        $date = $date->format('d-m-Y');

        $data = [
            'rut' => $args['rut'],
            'nombre' => $args['nombre'],
            'apellido' => $args['apellido'],
            'telefono' => $args['telefono'],
            'sueldo_mensual' => $args['sueldo_mensual'],
            'sueldo_diario' => $args['sueldo_diario'],
            'fecha' => $date,
            'active'=> 1,
            'role_id'=> $args['role'],
        ];

        $employee = Employee::create($data);

        return $employee;


    }
}
