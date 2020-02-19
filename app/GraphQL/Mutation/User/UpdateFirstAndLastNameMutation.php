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

class UpdateFirstAndLastNameMutation extends Mutation {

    protected $attributes = [
        'name' => 'UpdateFirstAndLastName',
        'description' => 'Update first and last name of the user'

    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => ['type' => Type::string()],
            'lastName' => ['type' => Type::string()],
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
            'name' => $args['name'],
            'lastName' => $args['lastName']
        ]);

        return $user;
    }

}