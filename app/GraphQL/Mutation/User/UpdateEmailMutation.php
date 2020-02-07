<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\Models\User;
use App\Models\RoleMapping;
use App\Models\Role;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdateEmailMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateEmailUser',
        'description' => 'Update a email of the user'

    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'email' => ['type' => Type::string(),'rules' => ['required', 'email', 'unique:users']],
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

        $user = User::find($args['id']);

        if(! $user)
        {
            return null;
        }

        // update user
        $user->update([
            'email' => $args['email']
        ]);

        return $user;
    }

}