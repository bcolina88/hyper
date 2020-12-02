<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Companie;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class CompanysQuery extends Query
{
    protected $attributes = [
        'name' => 'companys',
        'description' => 'Companys list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('CompanyType'));
    }

    public function args()
    {
       
    }

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/
        
        $companys = Companie::all();
        return $companys;

    }
}
