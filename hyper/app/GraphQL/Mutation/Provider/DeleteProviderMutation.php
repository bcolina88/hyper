<?php

namespace App\GraphQL\Mutation\Provider;

use GraphQL;
use App\Models\Provider;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class DeleteProviderMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteProvider',
        'description' => 'Delete a provider.'

    ];

    public function type()
    {
        return GraphQL::type('ProviderType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {

        if( $provider = Provider::findOrFail($args['id']) ) {
            $provider->delete();
            return $provider;
        }
        return null;
    }

}