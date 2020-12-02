<?php

namespace App\GraphQL\Mutation\Role;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL;
use App\Models\Role;
use App\Models\Permiso;
use JWTAuth;

class CreateRolePermissionMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateRolePermission',
        'description' => 'Create a new role and permissions.'
    ];

    public function type()
    {
        return GraphQL::type('RoleType');
    }

    public function rules()
    {
        return [
            'name' => 'required|name|unique:roles'
        ];
    }

    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required','unique:roles']
            ],
            'permissions' => [
                'name' => 'permissions', 
                 'type' => Type::listOf(new InputObjectType([
                    'name' => 'permi',
                    'fields' => [ 
                        'agregar'     => ['name' => 'agregar', 'type' => Type::id()],
                        'editar'      => ['name' => 'editar', 'type' => Type::id()],
                        'ver'         => ['name' => 'ver', 'type' => Type::id()],
                        'inhabilitar' => ['name' => 'inhabilitar', 'type' => Type::id()],   
                        'borrar'      => ['name' => 'borrar', 'type' => Type::id()],   
                        'maestro'     => ['name' => 'maestro', 'type' => Type::id()],   
                    ]
                ]))
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

        $permissions = $args['permissions'];

        $data = [
            'name'     => $args['name'],
            'description' =>  $args['name'],
            'type' => 'Usuario',
            'active' => 1
        ];

        $role = Role::create($data);


        foreach ($permissions as $key => $item) {

            $permisoItems = new Permiso;
          
            $permisoItems->rol_id      = $role->id;
            $permisoItems->maestro_id  = $item['maestro'];
            $permisoItems->agregar     = $item['agregar'];
            $permisoItems->editar      = $item['editar'];
            $permisoItems->ver         = $item['ver'];
            $permisoItems->inhabilitar = $item['inhabilitar'];
            $permisoItems->borrar      = $item['borrar'];
            $permisoItems->save();
          
        }



        return $role;

    }
}
