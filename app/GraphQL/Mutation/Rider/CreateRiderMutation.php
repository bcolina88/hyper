<?php

namespace App\GraphQL\Mutation\Rider;

use GraphQL;
use JWTAuth;
use App\Models\Rider;
use App\Models\User;
use App\Models\DiscountCoupon;
use App\Models\RiderHasCoupon;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class CreateRiderMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateRider',
        'description' => 'Create a new rider.'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'name' => [
                'type' => Type::string(),
            ],
            'lastName' => [
                'type' => Type::string(),
            ],
            'dni' => [
                'type' => Type::string(),
            ],
            'email' => [
                'type' => Type::string()
            ],
            'username' => [
                'type' => Type::string()
            ],
            'phone' => [
                'type' => Type::string()
            ],
            'birthDate' => [
                'type' => Type::string()
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'min:6']
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/


        $user = User::create([
            'name'     => $args['name'],
            'lastName' => $args['lastName'],
            'dni'      => $args['dni'],
            'email'    => $args['email'],
            'username' => $args['username'],
            'phone'    => $args['phone'],
            'fullName' => '',
            'birthDate'=> $args['birthDate'],
            'password' => bcrypt($args['password']),
            'active'   => 1,
            'role_id'  => 4,
            'profile_picture'=> '',
        ]);

        $rider = Rider::create([
            'x' => 0.000000,
            'y' => 0.000000,
            'active' => true,
            'user_id' => $user->id,
        ]);


        $discountCoupon = DiscountCoupon::all();

        foreach ($discountCoupon as $key) {

            if ($key->active ===1 ) {

                $data1= [
                    'discountCoupon_id'  => $key->id,
                    'rider_id'          => $rider->id,
                ];

                $riderHasCoupon = RiderHasCoupon::create($data1);

            }
        }

        return $user;

    }
}
