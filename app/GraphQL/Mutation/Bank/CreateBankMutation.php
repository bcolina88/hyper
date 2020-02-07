<?php

namespace App\GraphQL\Mutation\Bank;


use GraphQL;
use App\Models\Bank;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use JWTAuth;


class CreateBankMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateBank',
        'description' => 'Create a new bank.'
    ];

    public function type()
    {
        return GraphQL::type('Bank');
    }

    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required','unique:banks']
            ],
            'currency' => [
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
            'name' => $args['name'],
            'currency_id' => $args['currency']
        ];

        $bank = Bank::create($data);

        return $bank;


    }
}
