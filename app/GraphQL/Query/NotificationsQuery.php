<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Notification;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class NotificationsQuery extends Query {

    protected $attributes = [
        'name' => 'notifications',
        'description' => 'Notifications list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Notification'));
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $notifications = Notification::all();
        return $notifications;
    }
}