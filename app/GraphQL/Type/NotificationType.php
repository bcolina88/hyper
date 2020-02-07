<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\Notification;
use App\Models\Role;
use App\Models\User;

class NotificationType extends BaseType
{
    protected $attributes = [
        'name' => 'Notification',
        'description' => 'Notification type',
        'model'       => Notification::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'title' => [
                'type' => Type::nonNull(Type::string())
            ],
            'description' => [
                'type' => Type::nonNull(Type::string())
            ],
            'state' => [
                'type' => Type::nonNull(Type::string())
            ],
            'fromUser' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
            'toUser' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->toDateTimeString();
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at->toDateTimeString();
    }
}
