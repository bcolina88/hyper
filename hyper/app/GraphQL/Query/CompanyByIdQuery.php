<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Companie;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class CompanyByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'companyById',
        'description' => 'companyById list.'
    ];

    public function type()
    {
        

        return GraphQL::type('CompanyType');

    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
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

        if (isset($args['id'])) {


            return Companie::find($args['id']);



        }


    }
}
