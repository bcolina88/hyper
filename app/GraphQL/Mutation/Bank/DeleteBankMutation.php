<?php

namespace App\GraphQL\Mutation\Bank;

use GraphQL;
use App\Models\Bank;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class DeleteBankMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteBank',
        'description' => 'Delete a bank.'

    ];

    public function type()
    {
        return GraphQL::type('Bank');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
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


        if( $bank = Bank::findOrFail($args['id']) ) {
            $bank->delete();
            return $bank;
        }
        return null;
    }

}