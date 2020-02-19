<?php

namespace App\GraphQL\Mutation\Location;

use GraphQL;
use App\Models\Location;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;



class CreateLocationMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Create Location',
        'description' => 'Create a new Location.'
    ];

    public function type()
    {
        return GraphQL::type('Location');
    }


    public function args()
    {
        return [
            'x' => [
                'type' => Type::string()
            ],
            'y' => [
                'type' => Type::string()
            ],
            'address' => [
                'type' => Type::string()
            ],
            'name' => [
                'type' => Type::string()
            ],
            'percentagePriceIncrease' => [
                'type' => Type::string()
            ],
            'durationIncrease' => [
                'type' => Type::string()
            ],
            'increaseStartDate' => [
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

        $data = [
            'x'                         => $args['x'],
            'y'                         => $args['y'],
            'name'                      => $args['name'],
            'address'                   => $args['address'],
            'percentagePriceIncrease'   => $args['percentagePriceIncrease'],
            'durationIncrease'          => $args['durationIncrease'],
            'increaseStartDate'         => $args['increaseStartDate'],
        ];

        $Location = Location::create($data);

        return $Location;

    }
}
