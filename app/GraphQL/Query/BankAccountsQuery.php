<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\BankAccount;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JWTAuth;

class BankAccountsQuery extends Query {

    protected $attributes = [
        'name' => 'bankAccounts',
        'description' => 'BankAccounts list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('BankAccount'));
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $bankAccounts = BankAccount::all();
        return $bankAccounts;
    }
}