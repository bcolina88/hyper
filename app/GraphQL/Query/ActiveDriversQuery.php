<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Driver;
use App\Models\User;
use App\Models\Car;
use App\Models\Rating;
use App\Models\DriverHasCar;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;


class ActiveDriversQuery extends Query
{
    protected $attributes = [
        'name' => 'activeDrivers',
        'description' => 'Active Drivers.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('ActiveDriver'));
    }


    public function resolve($root, $args, $context, ResolveInfo $info)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $driver = Driver::where('status',1)->get();

        $response =[];

        foreach ($driver as $key) {

            $user = User::where('id',$key->user_id)->first();
            $rating = Rating::where('typeId',$key->id)->first();


            $driverHasCar = DriverHasCar::where('driver_id',$key->id)->get();

            $car =[];
            foreach ($driverHasCar as $items) {
                 $detailsCar = Car::where('id',$items->car_id)->first();
                 array_push($car,$detailsCar);
            }

            $details = array(
                    'id' => $key->id,
                    'x' => $key->x,
                    'y' => $key->y,
                    'kmWorked' => $key->kmWorked,
                    'availableTravelOtherStates' => $key->availableTravelOtherStates,
                    'nightTripsAvailable' => $key->nightTripsAvailable,
                    'active' => $key->active,
                    'accountStatus' => $key->accountStatus,
                    'residenceAddress' =>$key->residenceAddress,
                    'profilePicture' =>$key->profilePicture,
                    'user' => $user,
                    'rating' => $rating,
                    'car' => $car
            );

            array_push($response,$details);

        }



        return $response;


    }
}
