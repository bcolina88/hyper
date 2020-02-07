<?php

namespace App\GraphQL\Mutation\User;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL;
use JWTAuth;

class ResetPasswordMutation extends Mutation {

    protected $attributes = [
        'name' => 'resetPasswordUser',
        'description' => 'Reset Password a user.'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'password' => ['type' => Type::nonNull(Type::string()) ],
            'confirmation' => ['type' => Type::nonNull(Type::string()) ],
            'token' => ['type' => Type::nonNull(Type::string()) ]
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


        $user = JWTAuth::setToken($args['token'])->toUser();

        if (!$args['password'] ||
                !$args['confirmation'] ||
                $args['password'] !== $args['confirmation']) {

                return null;
        }

        // update password
        $fields = isset($args['password'])
                ? array_merge($args, ['password' => bcrypt($args['password'])])
                : $args;

        $user->update($fields);

        return $user;
    }

}