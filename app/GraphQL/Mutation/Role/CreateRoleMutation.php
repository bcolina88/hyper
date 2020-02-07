<?php

namespace App\GraphQL\Mutation\Role;


use GraphQL;
use JWTAuth;
use App\Models\Role;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class CreateRoleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateRole',
        'description' => 'Create a new role.'
    ];

    public function type()
    {
        return GraphQL::type('Role');
    }

    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required','unique:roles']
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
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

        $data = [
            'name'     => $args['name'],
            'description' => $args['description'],
            'active' => 1
        ];

        $role = Role::create($data);

        return $role;

    }
}
