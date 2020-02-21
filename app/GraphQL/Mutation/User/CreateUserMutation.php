<?php

namespace App\GraphQL\Mutation\User;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL;
use App\Models\User;
use App\Models\RoleMapping;
use JWTAuth;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateUser',
        'description' => 'Create a new user.'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required','min:2']
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email', 'unique:users']
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'min:6']
            ],
            'lastName' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'username' => [
                'type' => Type::nonNull(Type::string())
            ],
            'phone' => [
                'type' => Type::string()
            ],
            'dni' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'max:10']
            ],
            'birthDate' => [
                'type' => Type::string()
            ],
            'role' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ]
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


        $data = [
            'name'            => $args['name'],
            'email'           => $args['email'],
            'password'        => bcrypt($args['password']),
            'lastName'        => $args['lastName'],
            'fullName'        => $args['name'].' '.$args['lastName'],
            'phone'           => $args['phone'],
            'dni'             => $args['dni'],
            'birthDate'       => $args['birthDate'],
            'active'          => 1,
            'username'        => $args['username'],
            'role_id'         => $args['role'],
            'age'             => $edad,
            'profile_picture' => '',
        ];

        $user = User::create($data);

        RoleMapping::create([
            'user_id'  => $user->id,
            'role_id'  => $args['role']
        ]);

        return $user;

    }
}
