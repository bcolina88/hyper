<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Notification;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class NotificationsPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'notificationPagination',
        'description' => 'Notifications list.'
    ];

    public function type()
    {
        return GraphQL::type('NotificationPagination');
    }

    public function args()
    {
        return [
            'page' => [
                'name' => 'page',
                'type' => Type::nonNull(Type::int())
            ]
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

        $skip = env('LIMIT', 10) * $args['page'];
        $notifications = Notification::skip($skip)->take(env('LIMIT', 10))->get();
        $total = Notification::count();

        return ['data' => $notifications, 'total' => $total];
    }
}