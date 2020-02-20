<?php

namespace App\GraphQL\Mutation\Ride;

use GraphQL;
use JWTAuth;
use Carbon\Carbon;
use DB;
use App\Models\Ride;
use App\Models\RiderAddresses;
use App\Models\Location;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class CreateRideMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateRide',
        'description' => 'Create a new ride.'
    ];

    public function type()
    {
        return GraphQL::type('Ride');
    }

    public function args()
    {
        return [
            'xOrig' => [
                'type' => Type::string(),
            ],
            'yOrig' => [
                'type' => Type::string(),
            ],
            'xDest' => [
                'type' => Type::string(),
            ],
            'yDest' => [
                'type' => Type::string(),
            ],
            'pickupTime' => [
                'type' => Type::string(),
            ],
            'totalPrice' => [
                'type' => Type::string(),
            ],
            'luggage' => [
                'type' =>  Type::string()
            ],
            'dropoffTime' => [
                'type' => Type::string(),
            ],
            'duration' => [
                'type' =>  Type::int(),
            ],
            'distance' => [
                'type' =>  Type::int(),
            ],
            'pets' => [
                'type' =>  Type::string(),
            ],
            'pickupAddr' => [
                'type' =>  Type::string(),
            ],
            'destAddr' => [
                'type' =>  Type::string(),
            ],
            'note' => [
                'type' =>  Type::string(),
            ],
            'travellers' => [
                'type' =>  Type::int(),
            ],
            'rider' => [
                'type' =>  Type::id(),
            ],
            'driver' => [
                'type' =>  Type::id(),
            ],
            'car' => [
                'type' =>  Type::id(),
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

        $data = [

            'xOrig' => $args['xOrig'],
            'yOrig' => $args['yOrig'],
            'xDest' => $args['xDest'],
            'yDest' => $args['yDest'],
            'totalPrice' => $args['totalPrice'],
            'pendingPayment' =>  $args['totalPrice'],
            'totalPaid'      => 0,
            'pickupTime'  =>$args['pickupTime'],
            'dropoffTime'  => $args['dropoffTime'],
            'duration' => $args['duration'],
            'distance' => $args['distance'],
            'pets'  => $args['pets'],
            'luggage' => $args['luggage'],
            'pickupAddr' => $args['pickupAddr'],
            'destAddr' => $args['destAddr'],
            'note' => $args['note'],
            'travellers' => $args['travellers'],
            'status'  => 'InProcess',
            'payment'  => 0,
            'rider_id'   => $args['rider'],
            'driver_id'  => $args['driver'],
            'car_id'  => $args['car'],

        ];

        $ride = Ride::create($data);

        //$location = Location::where('x',$args['xDest'])->where('y',$args['yDest'])->get();

        /*
        $data1 = [
            'ride_id' => $ride->id,
            'location_id' => $location->id
        ];

        $RiderAddresses = RiderAddresses::create($data1);*/

        return $ride;

    }
}
