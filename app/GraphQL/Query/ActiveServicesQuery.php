<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Driver;
use App\Models\User;
use App\Models\Car;
use App\Models\Rating;
use App\Models\Ride;
use App\Models\DriverHasCar;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class ActiveServicesQuery extends Query
{
    protected $attributes = [
        'name' => 'activeServices',
        'description' => 'Active Services.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('ActiveService'));
    }


    public function resolve($root, $args, $context, ResolveInfo $info)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $ride = Ride::where('status','InProcess')->get();

        $response =[];

        foreach ($ride as $key) {

            $details = array(
                    'id' => $key->id,
                    'pickupAddr' => $key->pickupAddr,
                    'destAddr' => $key->destAddr,
                    'status' => $key->status,
                    'price' => $key->totalPrice,
                    'rider' => $key->rider,
                    'driver' => $key->driver,
                    'car' => $key->car,
            );

            array_push($response,$details);

        }



        return $response;


    }
}
