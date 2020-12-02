<?php

namespace App\GraphQL\Mutation\Rate;

use GraphQL;
use App\Models\Rate;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use JWTAuth;

class DeleteRateMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteRate',
        'description' => 'Delete a rate.'

    ];

    public function type()
    {
        return GraphQL::type('RateType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
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

        if( $rate = Rate::findOrFail($args['id']) ) {
            $rate->delete();
            return $rate;
        }
        return null;
    }

}