<?php

namespace App\GraphQL\Mutation\Auth;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL;
use JWTAuth;
use JWTFactory;

class RefreshTokenMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RefreshToken',
        'description' => 'Refresh expired token.'
    ];

    public function type()
    {
        return GraphQL::type('StringType');
    }

    public function args()
    {
        return [
            'token' => [
                'type' => Type::nonNull(Type::string())
            ]
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

        JWTAuth::setToken($args['token']);
        $token = JWTAuth::refresh();
        //$payload = JWTFactory::sub(1)->make();
        //$token = JWTAuth::encode($payload);
        //return $token;

        return compact('token');

        //$token = JWTAuth::setToken($args['token']);
        //$token = JWTAuth::encode($token);
        //$token = JWTAuth::refresh();


    }
}
