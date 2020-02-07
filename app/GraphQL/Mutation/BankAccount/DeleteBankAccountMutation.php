<?php

namespace App\GraphQL\Mutation\BankAccount;

use GraphQL;
use App\Models\BankAccount;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;


class DeleteBankAccountMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteBankAccount',
        'description' => 'Delete a bankAccount.'

    ];

    public function type()
    {
        return GraphQL::type('BankAccount');
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

        if( $bankAccount = BankAccount::findOrFail($args['id']) ) {
            $bankAccount->delete();
            return $bankAccount;
        }
        return null;
    }

}