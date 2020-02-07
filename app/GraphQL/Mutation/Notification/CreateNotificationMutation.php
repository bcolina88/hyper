<?php

namespace App\GraphQL\Mutation\Notification;

use GraphQL;
use JWTAuth;
use App\Models\Notification;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class CreateNotificationMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createNotification',
        'description' => 'Create a new Notification.'
    ];

    public function type()
    {
        return GraphQL::type('Notification');
    }

    public function args()
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string())
            ],
            'description' => [
                'type' => Type::nonNull(Type::string())
            ],
            'toUser' => [
                'type' => Type::nonNull(Type::id())
            ],
            'fromUser' => [
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
            'title'        => $args['title'],
            'description'  => $args['description'],
            'state'        => "created",
            'fromUser_id'  => $args['fromUser'],
            'toUser_id'    => $args['toUser']
        ];

        $notification = Notification::create($data);

        return $notification;

    }
}
