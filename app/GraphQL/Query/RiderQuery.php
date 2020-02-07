<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Rider;
use App\Models\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class RiderQuery extends Query
{
    protected $attributes = [
        'name' => 'RiderByID',
        'description' => 'Find an Rider.'
    ];

    public function type()
    {
        return GraphQL::type('Rider');
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

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $user = User::where('id', $args['id'])->first();
        $Rider = Rider::where('user_id', $user->id)->first();

        if($Rider) {

            return $Rider;
        }

        return null;



    }
}
