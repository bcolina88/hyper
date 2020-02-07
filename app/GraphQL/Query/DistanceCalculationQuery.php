<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class DistanceCalculationQuery extends Query
{
    protected $attributes = [
        'name' => 'DistanceCalculation',
        'description' => 'Distance Calculation.'
    ];

    public function type()
    {
         return GraphQL::type('FloatType');
    }

    public function args()
    {
        return [
            'point1_lat' => [
                'type' => Type::string(),
            ],
            'point1_long' => [
                'type' => Type::string(),
            ],
            'point2_lat' => [
                'type' => Type::string(),
            ],
            'point2_long' => [
                'type' => Type::string()
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

        $unit = 'km';
        $decimals = 2;

        $point1_lat = $args['point1_lat'];
        $point1_long = $args['point1_long'];
        $point2_lat = $args['point2_lat'];
        $point2_long = $args['point2_long'];

        $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));

        // Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
        switch($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
                break;
            case 'mi':
                $distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
                break;
            case 'nmi':
                $distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
        }

        $distance = round($distance, $decimals);
        return compact('distance');

    }
}
