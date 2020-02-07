<?php

namespace App\GraphQL\Mutation\Notification;

use GraphQL;
use App\Models\Notification;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class StateNotificationMutation extends Mutation {

    protected $attributes = [
        'name' => 'stateNotification',
        'description' => 'Blocked a Notification.'

    ];

    public function type()
    {
        return GraphQL::type('Notification');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::string())]
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

        $notification = Notification::find($args['id']);

        if($notification) {

            $notification->state = $args['status'];
            $notification->save();
            return $notification;
        }


        return null;
    }

}