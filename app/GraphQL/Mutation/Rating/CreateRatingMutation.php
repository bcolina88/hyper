<?php

namespace App\GraphQL\Mutation\Rating;

use GraphQL;
use JWTAuth;
use App\Models\Rating;
use App\Models\RideHasRating;

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
            'ride' => [
                'type' => Type::id()
            ],
            'assessmentDriver' => [
                'type' => Type::string()
            ],
            'assessment1' => [
                'type' => Type::string()
            ],
            'assessment2' => [
                'type' => Type::string()
            ],
            'assessment3' => [
                'type' => Type::string()
            ],
            'observations' => [
                'type' => Type::string()
            ],
            'valuedBy' => [
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

        $total = ($args['assessment1'] + $args['assessment2'] + $args['assessment3'])/3;


        $data = [
            'assessment1'      => $args['assessment1'],
            'assessment2'      => $args['assessment2'],
            'assessment3'      => $args['assessment3'],
            'observations'     => $args['observations'],
            'assessmentDriver' => $args['assessmentDriver'],
            'total'            => $total,
            'valuedBy'         => $args['valuedBy'],
        ];



        $Rating = Rating::create($data);

        $data1 = [
            'ride_id'    => $args['ride'],
            'rating_id'  => $Rating->id,            
        ];



        $RideHasRating = RideHasRating::create($data1);


        return $Rating;

    }
}
