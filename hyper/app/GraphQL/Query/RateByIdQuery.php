<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Rate;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class RateByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'rateById',
        'description' => 'rateById list.'
    ];

    public function type()
    {
        

        return GraphQL::type('RateType');

    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ]
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

        if (isset($args['id'])) {


            return Rate::find($args['id']);



        }


    }
}
