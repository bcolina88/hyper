<?php

namespace App\GraphQL\Mutation\Notification;

use GraphQL;
use App\Models\Notification;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdateNotificationMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateNotification',
        'description' => 'Update a Notification.'

    ];

    public function type()
    {
        return GraphQL::type('Notification');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'title' => [ 'type' => Type::string()],
            'description' => [ 'type' => Type::string()],
            'toUser' => [ 'type' => Type::id()],
            'fromUser' => [ 'type' => Type::id()]

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

        $Notification = Notification::find($args['id']);

        if(!$Notification)
        {
            return null;
        }

        // update Notification
        $Notification->update([
            'title'        => $args['title'],
            'description'  => $args['description'],
            'fromUser_id'  => $args['fromUser'],
            'toUser_id'    => $args['toUser']
        ]);

        return $Notification;

    }

}