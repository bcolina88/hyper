<?php

namespace App\GraphQL\Mutation\BankAccount;

use GraphQL;
use App\Models\BankAccount;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;

class UpdateBankAccountMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateBankAccount',
        'description' => 'Update a bankAccount.'

    ];

    public function type()
    {
        return GraphQL::type('BankAccount');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'accountNumber' => [ 'type' => Type::string()],
            'type' => [ 'type' => Type::string()],
            'currency' => [ 'type' => Type::string()],
            'comment' => [ 'type' => Type::string()],
            'owner' => [ 'type' => Type::id()],
            'bank' => [ 'type' => Type::id()]
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


        $bankAccount = BankAccount::find($args['id']);


        if(!$bankAccount)
        {
            return null;
        }


        $bankAccount->update([
                'accountNumber' => $args['accountNumber'],
                'type' => $args['type'],
                'currency' => $args['currency'],
                'comment' => $args['comment'],
                'owner_id' => $args['owner'],
                'bank_id' => $args['bank']
        ]);

        return $bankAccount;


    }

}