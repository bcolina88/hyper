<?php

namespace App\GraphQL\Mutation\Provider;

use GraphQL;
use App\Models\Provider;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;


class BlockedProviderMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteProvider',
        'description' => 'Blocked a provider.'

    ];

    public function type()
    {
        return GraphQL::type('ProviderType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'status' => ['name' => 'status', 'type' => Type::nonNull(Type::boolean())]
        ];
    }

    public function resolve($root, $args)
    {
        

        $provider = Provider::find($args['id']);
   
        if($provider) {
            
            $provider->active = $args['status'];
            $provider->save();

            return $provider;
        }

       
        return null;
    }

}