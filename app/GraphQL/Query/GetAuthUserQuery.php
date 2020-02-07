<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class GetAuthUserQuery extends Query
{
    protected $attributes = [
        'name' => 'getAuthUser',
        'description' => 'GetAuthUser query'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'token' => [
                'name' => 'token',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo)
    {

        JWTAuth::setToken($args['token']);
        if($user = JWTAuth::toUser()){
            return $user;
        };

    }
}