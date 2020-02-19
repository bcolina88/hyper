<?php

namespace App\GraphQL\Mutation\Location;

use GraphQL;
use App\Models\Location;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdateLocationMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateLocation',
        'description' => 'Update a Location.'

    ];

    public function type()
    {
        return GraphQL::type('Location');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'x' => [ 'type' => Type::string()],
            'y' => [ 'type' => Type::string()],
            'address' => [ 'type' => Type::string()],
            'name' => [ 'type' => Type::string()],
            'percentagePriceIncrease' => [ 'type' => Type::string()],
            'durationIncrease' => [ 'type' => Type::string()],
            'increaseStartDate' => [ 'type' => Type::string()]
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


        $Location = Location::find($args['id']);


        if(!$Location)
        {
            return null;
        }


        $Location->update([
            'x'                         => $args['x'],
            'y'                         => $args['y'],
            'address'                   => $args['address'],
            'name'                      => $args['name'],
            'percentagePriceIncrease'   => $args['percentagePriceIncrease'],
            'durationIncrease'          => $args['durationIncrease'],
            'increaseStartDate'         => $args['increaseStartDate'],
        ]);

        return $Location;


    }

}