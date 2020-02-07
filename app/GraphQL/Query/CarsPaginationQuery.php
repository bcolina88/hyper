<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Car;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JWTAuth;

class CarsPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'carPagination',
        'description' => 'Cars list.'
    ];

    public function type()
    {
       return GraphQL::type('CarPagination');
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
        $Cars = Car::skip($skip)->take(env('LIMIT', 10))->get();
        $total = Car::count();

        return ['data' => $Cars, 'total' => $total];
    }
}