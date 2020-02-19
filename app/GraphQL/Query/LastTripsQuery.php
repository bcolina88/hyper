<?php
namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Ride;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class LastTripsQuery extends Query {

    protected $attributes = [
        'name' => 'LastTrips',
        'description' => 'List of last trips'
    ];

    public function type()
    {
          return Type::listOf(GraphQL::type('Ride'));
    }

    public function args()
    {
        return [
            'rider' => [
                'name' => 'rider',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }



   public function resolve($root, $args, $context, ResolveInfo $resolveInfo)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $rides = Ride::where('rider_id',$args['rider'])->orderBy('created_at','DESC')->get();

        //$Rider = Rides::all();
        return $rides;
    }
}