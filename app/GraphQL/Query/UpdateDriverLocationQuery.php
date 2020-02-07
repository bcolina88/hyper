<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Driver;
use App\Models\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class UpdateDriverLocationQuery extends Query
{
    protected $attributes = [
        'name' => 'UpdateDriverLocation',
        'description' => 'Update Driver Location.'
    ];

    public function type()
    {
         return GraphQL::type('Driver');
    }

    public function args()
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'lat' => [
                'type' => Type::string(),
            ],
            'long' => [
                'type' => Type::string(),
            ],
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
        $driver = Driver::where('user_id', $user->id)->first();

        if($driver) {

            $driver->x = $args['lat'];
            $driver->y = $args['long'];
            $driver->save();
            return $driver;
        }

        return null;




    }
}
