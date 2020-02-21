<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Car;
use App\Models\Driver;
use App\Models\DriverHasCar;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class DriverDetailsQuery extends Query
{
    protected $attributes = [
        'name' => 'driverDetails',
        'description' => 'Driver Details.'
    ];

    public function type()
    {
        return GraphQL::type('DriverHasCar');
    }

    public function args()
    {
        return [
            'driverId' => [
                'name' => 'driverId',
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


        $DriverHasCar = DriverHasCar::where('driver_id',$args['driverId'])->first();
        return $DriverHasCar;


    }
}
