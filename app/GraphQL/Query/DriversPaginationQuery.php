<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Driver;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;


class DriversPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'driverPagination',
        'description' => 'Drivers list.'
    ];

    public function type()
    {
        return GraphQL::type('DriverPaginationType');
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
        $drivers = Driver::skip($skip)->take(env('LIMIT', 10))->get();
        $total = Driver::count();

        return ['data' => $drivers, 'total' => $total];
    }
}