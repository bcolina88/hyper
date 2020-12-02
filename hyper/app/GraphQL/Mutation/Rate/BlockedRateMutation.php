<?php

namespace App\GraphQL\Mutation\Rate;

use GraphQL;
use App\Models\Rate;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use JWTAuth;

class BlockedRateMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteRate',
        'description' => 'Blocked a rate.'

    ];

    public function type()
    {
        return GraphQL::type('RateType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::boolean())]
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
   
        if($rate) {
            
            $rate->active = $args['status'];
            $rate->save();
            return $rate;
        }

       
        return null;
    }

}