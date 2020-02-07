<?php

namespace App\GraphQL\Query;

use GraphQL;
use JWTAuth;
use App\Models\Bank;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class BanksQuery extends Query
{
    protected $attributes = [
        'name' => 'banks',
        'description' => 'Banks list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Bank'));
    }

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/

        $banks = Bank::all();
        return $banks;

    }
}
