<?php

namespace App\GraphQL\Mutation\Rate;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Rate;
//use App\Models\HistoricalRate;
use JWTAuth;

class CreateRateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateRate',
        'description' => 'Create a new rate.'
    ];

    public function type()
    {
        return GraphQL::type('RateType');
    }

    public function args()
    {
        return [
            'value' => [
                'type' => Type::nonNull(Type::string())
            ],
            'currency' => [
                'type' => Type::nonNull(Type::id())
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
            'value'     => $args['value'],
            'currency_id' => $args['currency'],
            'active' => 1
        ];

        $data1 = [
            'value'     => $args['value'],
            'currency_id' => $args['currency']
        ];

        $rate = Rate::create($data);
        //$historicalRate = HistoricalRate::create($data1);

        return $rate;

    }
}
