<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class UsersQuery extends Query {

    protected $attributes = [
        'name' => 'users',
        'description' => 'Users list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('UserType'));
    }

    public function args()
    {
        
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/
       
        $users = User::all();
        return $users;
    }
}