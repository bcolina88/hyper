<?php

namespace App\GraphQL\Mutation\Driver;


use GraphQL;
use JWTAuth;
use App\Models\Driver;
use App\Models\User;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class CreateDriverMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateDriver',
        'description' => 'Create a new driver.'
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
            'role_id'  => 3,
            'profile_picture'=> '',
        ]);

        $driver = Driver::create([
            'x' => 0.000000,
            'y' => 0.000000,
            'kmWorked' => 0.00,
            'availableTravelOtherStates' => false,
            'nightTripsAvailable' => false,
            'active' => true,
            'status' => false,
            'accountStatus'    => 'active',
            'residenceAddress' => '',
            'profilePicture' => '',
            'user_id' => $user->id,
        ]);




        return $user;

    }
}
