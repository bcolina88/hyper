<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use DB;
use App\Models\Car;
use App\Models\Driver;
use App\Models\DriverHasCar;
use App\Models\Upload;
use App\Models\RideHasRating;
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
        return GraphQL::type('DriverHasCarImage');
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


        $driverId = $args['driverId'];


        $DriverHasCar = DriverHasCar::where('driver_id',$args['driverId'])->first();
        $photos = Upload::where('car_id',$DriverHasCar->car_id)->get();

        $DriverHasCar->car['photos'] = $photos;


        $items =  DB::select(DB::raw("SELECT ratings.* FROM ride_has_ratings JOIN rides ON rides.id = ride_has_ratings.ride_id JOIN ratings ON ratings.id = ride_has_ratings.rating_id WHERE ratings.valuedBy='Rider' and rides.driver_id='$driverId'"));


        $total = 0;
        foreach ($items as $key => $value) {
            $total = $total + $value->total;
        }

        $DriverHasCar['rating'] = $items;

        if ($total === 0) {
            $DriverHasCar['totalRating'] = $total;
        }else{
            $DriverHasCar['totalRating'] = $total / count($items);

        }
        
        return $DriverHasCar;


    }
}
