<?php

namespace App\GraphQL\Mutation\CurrencyRate;

use GraphQL;
use JWTAuth;
use App\Models\CurrencyRate;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class UpdateCurrencyRateMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateCurrencyRate',
        'description' => 'Update a currency rate.'

    ];

    public function type()
    {
        return GraphQL::type('CurrencyRate');
    }

    public function args()
    {
        return [

            'id' => ['type' => Type::nonNull(Type::int())],
            'value' => [ 'type' => Type::string()],
            'currency' => [ 'type' => Type::id()],
            'updatedBy' => [ 'type' => Type::int()]

        ];
    }

   /* public function rules()
    {
        return [
            'name' => 'min:2',
            'description' => 'min:2'
        ];
    }*/

    public function resolve($root, $args)
    {

        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/



        $CurrencyRate = CurrencyRate::find($args['id']);

        if(!$CurrencyRate)
        {
            return null;
        }


        $CurrencyRate->update([
            'value' => $args['value'],
            'currency_id' => $args['currency'],
            'updatedBy_id'=> $args['updatedBy']
        ]);



        return $CurrencyRate;
    }

}