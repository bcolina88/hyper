<?php

namespace App\GraphQL\Mutation\Notification;

use GraphQL;
use App\Models\Notification;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class DeleteNotificationMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteNotification',
        'description' => 'Delete a Notification.'

    ];

    public function type()
    {
        return GraphQL::type('Notification');
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

        if( $notification = Notification::findOrFail($args['id']) ) {
            $notification->delete();
            return $notification;
        }
        return null;
    }

}