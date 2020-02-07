<?php

namespace App\GraphQL\Mutation\TravelRate;

use GraphQL;
use JWTAuth;
use App\Models\TravelRate;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class CreateTravelRateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateTravelRate',
        'description' => 'Create a new travel rate.'
    ];

    public function type()
    {
        return GraphQL::type('TravelRate');
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
            'value' => [
                'type' => Type::string()
            ],
            'distance' => [
                'type' => Type::int()
            ],
            'adrees'=> [
                'type' => Type::string()
            ],
            'currency' => [
                'type' => Type::nonNull(Type::id())
            ],
            'createdBy' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
            'updatedBy' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
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
            'x'     => $args['x'],
            'y'     => $args['y'],
            'distance'     => $args['distance'],
            'adrees'     => $args['adrees'],
            'value'     => $args['value'],
            'currency_id' => $args['currency'],
            'active' => 1,
            'createdBy_id'=> $args['createdBy'],
            'updatedBy_id'=> $args['updatedBy']
        ];

        $TravelRate = TravelRate::create($data);


        return $TravelRate;

    }
}
