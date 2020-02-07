<?php

namespace App\GraphQL\Mutation\BankAccount;

use GraphQL;
use App\Models\BankAccount;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;



class CreateBankAccountMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Create BankAccount',
        'description' => 'Create a new bankAccount.'
    ];

    public function type()
    {
        return GraphQL::type('BankAccount');
    }


    public function args()
    {
        return [

            'bank' => [
                'type' => Type::nonNull(Type::id()),
                'rules' => ['required']
            ],
            'accountNumber' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required|unique:bank_accounts']
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'currency' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'comment' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'owner' => [
                'type' => Type::nonNull(Type::id()),
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

        $data = [
            'accountNumber' => $args['accountNumber'],
            'type'          => $args['type'],
            'currency'      => $args['currency'],
            'comment'       => $args['comment'],
            'owner_id'      => $args['owner'],
            'bank_id'       => $args['bank'],
            'beginningBalance' => 0.00,
            'currentBalance' => 0.00,
        ];

        $bankAccount = BankAccount::create($data);

        return $bankAccount;

    }
}
