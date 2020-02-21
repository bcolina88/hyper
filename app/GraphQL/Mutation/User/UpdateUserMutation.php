<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleMapping;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdateUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateUser',
        'description' => 'Update a user.'

    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => [ 'type' => Type::string()],
            'lastName' => ['type' => Type::string()],
            'phone' => ['type' => Type::string()],
            'dni' => [ 'type' => Type::string()],
            'birthDate' => ['type' => Type::string()],
            'username' => ['type' => Type::string()],
            'role' => ['type' => Type::int()],
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


        $user = User::find($args['id']);

        if(! $user)
        {
            return null;
        }

        $role = RoleMapping::where('user_id', $args['id']);
        $role->update(['role_id' => $args['role']]);


        // update user
        $user->update([
            'name' => $args['name'],
            'lastName' => $args['lastName'],
            'phone' => $args['phone'],
            'dni' => $args['dni'],
            'role_id'=> $args['role'],
            'fullName' => $args['name'].' '.$args['lastName'],
            'birthDate' => $args['birthDate'],
            'username' => $args['username'],
            'age'      => $edad,

        ]);

        return $user;
    }

}