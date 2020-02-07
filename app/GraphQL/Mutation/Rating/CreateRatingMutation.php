<?php

namespace App\GraphQL\Mutation\Rating;

use GraphQL;
use JWTAuth;
use App\Models\Rating;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class CreateRatingMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateRating',
        'description' => 'Create a new rating.'
    ];

    public function type()
    {
        return GraphQL::type('Rating');
    }

    public function args()
    {
        return [
            'type' => [
                'type' => Type::string()
            ],
            'typeId' => [
                'type' => Type::int()
            ],
            'question1' => [
                'type' => Type::string()
            ],
            'assessment1' => [
                'type' => Type::string()
            ],
            'question2' => [
                'type' => Type::string()
            ],
            'assessment2' => [
                'type' => Type::string()
            ],
            'question3' => [
                'type' => Type::string()
            ],
            'assessment3' => [
                'type' => Type::string()
            ],
            'observations' => [
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

        $total = $args['assessment1'] + $args['assessment2'] + $args['assessment3'];


        $data = [
            'type'         => $args['type'],
            'typeId'       => $args['typeId'],
            'question1'    => $args['question1'],
            'assessment1'  => $args['assessment1'],
            'question2'    => $args['question2'],
            'assessment2'  => $args['assessment2'],
            'question3'    => $args['question3'],
            'assessment3'  => $args['assessment3'],
            'observations' => $args['observations'],
            'total'        => $total,
        ];

        $Rating = Rating::create($data);


        return $Rating;

    }
}
