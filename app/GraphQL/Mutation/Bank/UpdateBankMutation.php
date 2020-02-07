<?php

namespace App\GraphQL\Mutation\Bank;

use GraphQL;
use App\Models\Bank;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdateBankMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateBank',
        'description' => 'Update a bank.'

    ];

    public function type()
    {
        return GraphQL::type('Bank');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => [ 'type' => Type::string()],
            'currency' => [ 'type' => Type::id()]

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

        $bank = Bank::find($args['id']);


        if(!$bank)
        {
            return null;
        }


            // update bank
        $bank->update([
            'name' => $args['name'],
            'currency_id' => $args['currency']
        ]);

        return $bank;

    }

}