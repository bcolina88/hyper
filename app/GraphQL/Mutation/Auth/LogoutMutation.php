<?php

namespace App\GraphQL\Mutation\Auth;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;
use GraphQL;
use App\Models\Driver;


class LogoutMutation extends Mutation
{
    protected $attributes = [
        'name' => 'LogoutMutation',
        'description' => 'Logout.'
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
        $user = JWTAuth::toUser();

        //Cambio status

        if ($user->role_id === 3) {


            $Driver = Driver::where('user_id',$user->id)->first();
            $Driver->update([
                'status' => false,
            ]);

        }
         //Fin Cambio status

        JWTAuth::invalidate(JWTAuth::getToken());
        $token ='Successfully logged out';
        return compact('token');
    }
}
