<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JWTAuth;


class UsersPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'users',
        'description' => 'Users list.'
    ];

    public function type()
    {
        return GraphQL::type('UserPaginationType');
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
        $users = User::skip($skip)->take(env('LIMIT', 10))->get();
        $total = User::count();

        return ['data' => $users, 'total' => $total];
    }
}