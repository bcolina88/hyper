<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\Notification;

class NotificationPaginationType extends BaseType
{
    protected $attributes = [
        'name' => 'NotificationPagination',
        'description' => 'A pagination'
    ];

    public function fields()
    {
        return [
            'data' => [
                'type' => Type::listOf(GraphQL::type('Notification')),
                'description' => 'Notifications'
            ],
            'total' => [
                'type' => Type::int(),
                'description' => 'The total'
            ]
        ];
    }
}
