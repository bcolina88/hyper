<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Location;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JWTAuth;

class LocationsPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'locationPagination',
        'description' => 'Locations list.'
    ];

    public function type()
    {
       return GraphQL::type('LocationPagination');
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
        $Locations = Location::skip($skip)->take(env('LIMIT', 10))->get();
        $total = Location::count();

        return ['data' => $Locations, 'total' => $total];
    }
}