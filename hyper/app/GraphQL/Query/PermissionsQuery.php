<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Permiso;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class PermissionsQuery extends Query {

    protected $attributes = [
        'name' => 'permissions',
        'description' => 'Permissions list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('PermisoType'));
    }

    public function args()
    {
        
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/
       
        //$roles = Role::all();
        //return $roles;

        $permissions = Permiso::where('rol_id', 1)->with('maestro')->get();
        return $permissions;

       // return response()->Json($permissions, 200, [], JSON_NUMERIC_CHECK);
    }
}