<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\BankAccount;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JWTAuth;


class BankAccountsPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'bankAccountPagination',
        'description' => 'BankAccounts list.'
    ];

    public function type()
    {
        return GraphQL::type('BankAccountPagination');
    }

    public function args()
    {
        return [
            'page' => [
                'name' => 'page',
                'type' => Type::nonNull(Type::int())
            ]
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

        $skip = env('LIMIT', 10) * $args['page'];
        $bankAccounts = BankAccount::skip($skip)->take(env('LIMIT', 10))->get();
        $total = BankAccount::count();

        return ['data' => $bankAccounts, 'total' => $total];
    }
}