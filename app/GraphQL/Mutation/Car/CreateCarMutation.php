<?php

namespace App\GraphQL\Mutation\Car;

use GraphQL;
use JWTAuth;
use App\Models\Car;
use App\Models\DriverHasCar;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class CreateCarMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateCar',
        'description' => 'Create a new car.'
    ];

    public function type()
    {
        return GraphQL::type('Car');
    }

    public function args()
    {
        return [
            'driver' => [
                'type' => Type::id()
            ],
            'model' => [
                'type' => Type::id()
            ],
            'typeCar' => [
                'type' => Type::id()
            ],
            'type' => [
                'type' => Type::string()
            ],
            'color' => [
                'type' => Type::string()
            ],
            'confort' => [
                'type' => Type::string()
            ],
            'upholstery' => [
                'type' => Type::string()
            ],
            'paintState' => [
                'type' => Type::string()
            ],
            'year' => [
                'type' => Type::string()
            ],
            'registrationDate' => [
                'type' => Type::string()
            ],
            'lastCheckDate' => [
                'type' => Type::string()
            ],
            'status' => [
                'type' => Type::string()
            ],
            'vehicleStatus' => [
                'type' => Type::string()
            ],
            'travelOtherStates' => [
                'type' => Type::string()
            ],
            'plateNumber' => [
                'type' => Type::string()
            ],
            'circulationCertificate' => [
                'type' => Type::string()
            ],
            'propertyTitle' => [
                'type' => Type::string()
            ],
            'serialCar' => [
                'type' => Type::string()
            ],
            'armoredLevel' => [
                'type' => Type::int()
            ],
            'airConditioning' => [
                'type' => Type::boolean()
            ],
            'armored' => [
                'type' => Type::boolean()
            ],
             'lateralMirrors' => [
                'type' => Type::boolean()
            ],
            'rearViewMirror' => [
                'type' => Type::boolean()
            ],
            'frontLights' => [
                'type' => Type::boolean()
            ],
            'taillights' => [
                'type' => Type::boolean()
            ],
            'blinkingLights' => [
                'type' => Type::boolean()
            ],
            'rubbersState' => [
                'type' => Type::string()
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

        $data = [
            'model_id'         => $args['model'],
            'typeCar_id'       => $args['typeCar'],
            'type'             => $args['type'],
            'color'            => $args['color'],
            'confort'          => $args['confort'],
            'paintState'       => $args['paintState'],
            'year'             => $args['year'],
            'registrationDate' => $args['registrationDate'],
            'lastCheckDate'     => $args['lastCheckDate'],
            'status'            => $args['status'],
            'vehicleStatus'     => $args['vehicleStatus'],
            'travelOtherStates' => $args['travelOtherStates'],
            'plateNumber'       => $args['plateNumber'],
            'circulationCertificate' => $args['circulationCertificate'],
            'propertyTitle'     => $args['propertyTitle'],
            'serialCar'         => $args['serialCar'],
            'armoredLevel'      => $args['armoredLevel'],
            'airConditioning'   => $args['airConditioning'],
            'armored'           => $args['armored'],
            'lateralMirrors'   => $args['lateralMirrors'],
            'rearViewMirror'    => $args['rearViewMirror'],
            'frontLights'       => $args['frontLights'],
            'taillights'        => $args['taillights'],
            'blinkingLights'    => $args['blinkingLights'],
            'rubbersState'      => $args['rubbersState']

        ];

        $car = Car::create($data);


        $driverHasCar = DriverHasCar::create([
            'car_id' => $car->id,
            'driver_id' => $args['driver'],
        ]);

        return $car;

    }
}
