<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Rider;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;


class RidersPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'RiderPagination',
        'description' => 'Riders list.'
    ];

    public function type()
    {
        return GraphQL::type('RiderPaginationType');
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
        $Riders = Rider::skip($skip)->take(env('LIMIT', 10))->get();
        $total = Rider::count();

        return ['data' => $Riders, 'total' => $total];
    }
}