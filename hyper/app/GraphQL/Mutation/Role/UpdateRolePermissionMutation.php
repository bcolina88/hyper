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

class UpdateRolePermissionMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateRolePermission',
        'description' => 'Update a role and permissions.'
    ];

    public function type()
    {
        return GraphQL::type('RoleType');
    }


    public function args()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => [
                'type' => Type::nonNull(Type::string())
            ],
            'permissions' => [
                'name' => 'permissions', 
                 'type' => Type::listOf(new InputObjectType([
                    'name' => 'permii',
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


        $role = Role::where('id', $args['id'])->first();
        $role->name = $args['name'];
        $role->save();


        $permisoRole = Permiso::where('rol_id','=',$args['id'])->get();


        foreach ($permisoRole as $key => $item) {
            Permiso::destroy($item['id']);
        }


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
