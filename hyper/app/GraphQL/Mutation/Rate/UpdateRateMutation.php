<?php

namespace App\GraphQL\Mutation\Rate;

use GraphQL;
use App\Models\Rate;
//use App\Models\HistoricalRate;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use JWTAuth;

class UpdateRateMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateRate',
        'description' => 'Update a rate.'

    ];

    public function type()
    {
        return GraphQL::type('RateType');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'value' => [ 'type' => Type::string()],
            'currency' => [ 'type' => Type::int()]

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

        

        $rate = Rate::find($args['id']);

        if(!$rate)
        {
            return null;
        }

       
        $rate->update([
            'value' => $args['value'],
            'currency_id' => $args['currency']
        ]);

       /* $data1 = [
            'value'     => $args['value'],
            'currency_id' => $args['currency'],
            'createdBy_id'=> $args['updatedBy']
        ];

        $historicalRate = HistoricalRate::create($data1);*/



        return $rate;
    }

}