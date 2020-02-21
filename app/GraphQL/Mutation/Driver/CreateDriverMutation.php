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


         function busca_edad($fecha_nacimiento){
            $dia=date("d");
            $mes=date("m");
            $ano=date("Y");


            $dianaz=date("d",strtotime($fecha_nacimiento));
            $mesnaz=date("m",strtotime($fecha_nacimiento));
            $anonaz=date("Y",strtotime($fecha_nacimiento));


            //si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

            if (($mesnaz == $mes) && ($dianaz > $dia)) {
            $ano=($ano-1); }

            //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

            if ($mesnaz > $mes) {
            $ano=($ano-1);}

             //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

            $edad=($ano-$anonaz);


            return $edad;


        }


        $edad = busca_edad($args['birthDate']);


        $user = User::create([
            'name'     => $args['name'],
            'lastName' => $args['lastName'],
            'dni'      => $args['dni'],
            'email'    => $args['email'],
            'username' => $args['username'],
            'phone'    => $args['phone'],
            'fullName' => $args['name'].' '.$args['lastName'],
            'birthDate'=> $args['birthDate'],
            'password' => bcrypt($args['password']),
            'active'   => 1,
            'role_id'  => 3,
            'age'      => $edad,
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
