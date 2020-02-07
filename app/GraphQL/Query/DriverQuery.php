<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Driver;
use App\Models\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class DriverQuery extends Query
{
    protected $attributes = [
        'name' => 'driverByID',
        'description' => 'Find an driver.'
    ];

    public function type()
    {
        return GraphQL::type('Driver');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
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


        $user = User::where('id', $args['id'])->first();
        $Driver = Driver::where('user_id', $user->id)->first();

        if($Driver) {

            return $Driver;
        }

        return null;

    }
}
