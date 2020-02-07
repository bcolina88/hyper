<?php

namespace App\GraphQL\Mutation\Rider;

use GraphQL;
use App\Models\Rider;
use App\Models\User;
use App\Models\RiderHasCoupon;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class DeleteRiderMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteRider',
        'description' => 'Delete a rider.'

    ];

    public function type()
    {
        return GraphQL::type('User');
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


        if( $user = User::findOrFail($args['id']) ) {

            $RiderHasCoupon = RiderHasCoupon::where('rider_id',$user->id)->first();
            $RiderHasCoupon->delete();

            $Rider = Rider::where('user_id',$user->id)->first();
            $Rider->delete();


            $user->delete();
            return $user;
        }
        return null;
    }

}