<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Role;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class RolesQuery extends Query {

    protected $attributes = [
        'name' => 'roles',
        'description' => 'Roles list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Role'));
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