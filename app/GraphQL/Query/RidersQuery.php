<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Rider;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class RidersQuery extends Query {

    protected $attributes = [
        'name' => 'Riders',
        'description' => 'Riders list.'
    ];

    public function type()
    {
          return Type::listOf(GraphQL::type('Rider'));
    }



   public function resolve($root, $args, $context, ResolveInfo $resolveInfo)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $Rider = Rider::all();
        return $Rider;
    }
}