<?php

namespace App\GraphQL\Mutation\TravelRate;

use GraphQL;
use JWTAuth;
use App\Models\TravelRate;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class UpdateTravelRateMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateTravelRate',
        'description' => 'Update a travel rate.'

    ];

    public function type()
    {
        return GraphQL::type('TravelRate');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'x' => [ 'type' => Type::string()],
            'y' => [ 'type' => Type::string()],
            'distance' => [ 'type' => Type::int()],
            'value' => [ 'type' => Type::string()],
            'adrees' => [ 'type' => Type::string()],
            'currency' => [ 'type' => Type::id()],
            'updatedBy' => [ 'type' => Type::int()]

        ];
    }

   /* public function rules()
    {
        return [
            'name' => 'min:2',
            'description' => 'min:2'
        ];
    }*/

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/



        $TravelRate = TravelRate::find($args['id']);

        if(!$TravelRate)
        {
            return null;
        }


        $TravelRate->update([
            'x'     => $args['x'],
            'y'     => $args['y'],
            'distance'     => $args['distance'],
            'adrees'     => $args['adrees'],
            'value'     => $args['value'],
            'currency_id' => $args['currency'],
            'updatedBy_id'=> $args['updatedBy']
        ]);



        return $TravelRate;
    }

}