<?php

namespace App\GraphQL\Mutation\Auth;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;
use GraphQL;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;


class CreateTokenMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateToken',
        'description' => 'Get user credentials to create a authentication token.'
    ];

    public function type()
    {
        return GraphQL::type('StringType');
    }

    public function args()
    {
        return [
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email']
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'min:6']
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

        if (!$token = JWTAuth::attempt($args)) {
            return ['error' => 'Invalid credentials.'];
        }

        //Cambio status

        JWTAuth::setToken($token);
        $user = Auth::user();


        //$user = JWTAuth::toUser($token);

        if ($user->role_id === 3) {

            $Driver = Driver::where('user_id',$user->id)->first();

            $Driver->update([
                'status' => true,
            ]);

        }

        //Fin Cambio status

        return compact('token');
    }
}
