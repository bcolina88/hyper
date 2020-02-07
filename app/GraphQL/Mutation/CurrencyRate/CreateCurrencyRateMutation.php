<?php

namespace App\GraphQL\Mutation\CurrencyRate;

use GraphQL;
use JWTAuth;
use App\Models\CurrencyRate;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class CreateCurrencyRateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateCurrencyRate',
        'description' => 'Create a new currency rate.'
    ];

    public function type()
    {
        return GraphQL::type('CurrencyRate');
    }

    public function args()
    {
        return [
            'value' => [
                'type' => Type::nonNull(Type::string())
            ],
            'currency' => [
                'type' => Type::nonNull(Type::id())
            ],
            'createdBy' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
            'updatedBy' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],


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
            'value'     => $args['value'],
            'currency_id' => $args['currency'],
            'active' => 1,
            'createdBy_id'=> $args['createdBy'],
            'updatedBy_id'=> $args['updatedBy']
        ];

        $CurrencyRate = CurrencyRate::create($data);


        return $CurrencyRate;

    }
}
