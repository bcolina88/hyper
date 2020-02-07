<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Role;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class RolesPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'rolePagination',
        'description' => 'Roles list.'
    ];

    public function type()
    {
        return GraphQL::type('RolePagination');
    }

    public function args()
    {
        return [
            'page' => [
                'name' => 'page',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $skip = env('LIMIT', 10) * $args['page'];
        $roles = Role::skip($skip)->take(env('LIMIT', 10))->get();
        $total = Role::count();

        return ['data' => $roles, 'total' => $total];
    }
}