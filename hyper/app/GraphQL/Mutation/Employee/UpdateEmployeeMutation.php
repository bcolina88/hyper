<?php

namespace App\GraphQL\Mutation\Employee;

use GraphQL;
use App\Models\Employee;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateEmployeeMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateEmployee',
        'description' => 'Update a employee.'

    ];

    public function type()
    {
        return GraphQL::type('EmployeeType');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'rut' => [ 'type' => Type::string()],
            'nombre' => [ 'type' => Type::string()],
            'apellido' => [ 'type' => Type::string()],
            'telefono' => [ 'type' => Type::string()],
            'sueldo_mensual' => [ 'type' => Type::string()],
            'sueldo_diario' => [ 'type' => Type::string()],
            'role' => ['name' => 'role', 'type' => Type::nonNull(Type::id())],

           
        ];
    }



    public function resolve($root, $args)
    {
        

        $employee = Employee::find($args['id']);

        if(!$employee)
        {
            return null;
        }

        // update employee        
        $employee->update([
            'rut'   => $args['rut'],
            'nombre'   => $args['nombre'],
            'apellido' => $args['apellido'],
            'telefono' => $args['telefono'],
            'sueldo_mensual' => $args['sueldo_mensual'],
            'sueldo_diario' => $args['sueldo_diario'],
            'role_id'  => $args['role'],
            
        ]);
       
        return $employee;


    }

}