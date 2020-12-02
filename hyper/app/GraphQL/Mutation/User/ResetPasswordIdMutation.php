<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use App\Models\User;
use JWTAuth;

class ResetPasswordIdMutation extends Mutation {

    protected $attributes = [
        'name' => 'resetPasswordIdUser',
        'description' => 'Reset Password a user for id.'
    ];

    public function type()
    {
        return GraphQL::type('UserType');
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int()) ],
            'password' => ['type' => Type::nonNull(Type::string()) ],
            'confirmation' => ['type' => Type::nonNull(Type::string()) ],
        ];
    }



    public function resolve($root, $args)
    {
        

        $user = User::find($args['id']);


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