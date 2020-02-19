<?php

namespace App\GraphQL\Query;


use GraphQL;
use JWTAuth;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use App\Models\Rider;
use App\Models\Driver;
use DB;

class GetCurrentQuery extends Query {

    protected $attributes = [
        'name' => 'getCurrent',
        'description' => 'Get current user.'
    ];

    public function type()
    {
        return GraphQL::type('GetCurrent');
    }

    public function args()
    {
        return [
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

        $rider = Rider::where('user_id',$user->id)->first();
        $driver = Driver::where('user_id',$user->id)->first();

        $user['rider']=$rider;
        $user['driver']=$driver;

        return $user;
    }

}