<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Bank;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JWTAuth;

class BanksPaginationQuery extends Query {

    protected $attributes = [
        'name' => 'bankPagination',
        'description' => 'Banks list.'
    ];

    public function type()
    {
       return GraphQL::type('BankPagination');
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
        $banks = Bank::skip($skip)->take(env('LIMIT', 10))->get();
        $total = Bank::count();

        return ['data' => $banks, 'total' => $total];
    }
}