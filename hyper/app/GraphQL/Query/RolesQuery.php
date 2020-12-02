<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Role;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class RolesQuery extends Query {

    protected $attributes = [
        'name' => 'roles',
        'description' => 'Roles list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('RoleType'));
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
       
        $roles = Role::all();
        return $roles;
    }
}