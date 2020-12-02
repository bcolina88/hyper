<?php

namespace App\GraphQL\Mutation\Provider;

use GraphQL;
use App\Models\Provider;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class UpdateProviderMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateProvider',
        'description' => 'Update a provider.'

    ];

    public function type()
    {
        return GraphQL::type('ProviderType');
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => ['type' => Type::string()],
            'company' => ['type' => Type::string()],
            'description' => ['type' => Type::string()],
            'rif' => ['type' => Type::string()],
            'phone' => ['type' => Type::string()],
            'address' => ['type' => Type::string()],    
            'email' => ['type' => Type::string()]     
        ];
    }



    public function resolve($root, $args)
    {
        

        $provider = Provider::find($args['id']);

        if(!$provider)
        {
            return null;
        }

        // update user        
        $provider->update([
            'name'           => $args['name'],
            'company'        => $args['company'],
            'description'    => $args['description'],
            'rif'            => $args['rif'],
            'phone'          => $args['phone'],
            'address'        => $args['address'],
            'email'          => $args['email']
        ]);
       
        return $provider;
    }

}