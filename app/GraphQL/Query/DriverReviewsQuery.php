<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Driver;
use App\Models\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class DriverReviewsQuery extends Query
{
    protected $attributes = [
        'name' => 'driverReviews',
        'description' => 'Driver reviews.'
    ];

    public function type()
    {
        return GraphQL::type('Driver');
    }

    public function args()
    {
        return [
            'driver' => [
                'name' => 'driver',
                'type' => Type::nonNull(Type::int())
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



        $reviews = ReviewModel::with('user','driver')->where('driver_id', $request->get('user_id'));
        $reviews_count = $reviews->count();
        $reviews_avg = $reviews->avg('ratings');
        $reviews_list =  $reviews->get()->toArray();
        $review = array(
            'count' => $reviews_count,
            'ratings' => $reviews_avg == null ? 0 : $reviews_avg,
            'reviews' => $reviews_list
        );
        if ($reviews == null) {
            $data['success'] = 0;
            $data['message'] = "Unable to Receive Reviews Request Info. Please, Try again Later !";
            $data['data'] = "";
        } else{
            $data['success'] = 1;
            $data['message'] = "Data Received.";
            $data['data'] = $review;
        }
        return $data;




/*

        $user = User::where('id', $args['id'])->first();
        $Driver = Driver::where('user_id', $user->id)->first();

        if($Driver) {

            return $Driver;
        }

        return null;*/

    }
}
