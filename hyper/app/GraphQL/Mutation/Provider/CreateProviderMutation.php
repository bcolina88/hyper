<?php

namespace App\GraphQL\Mutation\Provider;

use GraphQL;
use App\Models\Provider;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;


class CreateProviderMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateProvider',
    ];

    public function type()
    {
        return GraphQL::type('ProviderType');
    }

    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required','min:2']
            ],
            'company' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required','min:2']
            ],
            'description' => [
                'type' => Type::string(),
            ],
            'rif' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'phone' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'address' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email', 'unique:providers']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        

        if ($args['description'] === '') {
            
            $data = [
                'name'        => $args['name'],
                'description' => NULL,
                'company'     => $args['company'],
                'rif'         => $args['rif'],
                'phone'       => $args['phone'],
                'address'     => $args['address'],
                'email'       => $args['email'],          
                'active'      => 1
            ];

        }else{

            $data = [
                'name'        => $args['name'],
                'company'     => $args['company'],
                'rif'         => $args['rif'],
                'description' => $args['description'],
                'phone'       => $args['phone'],
                'address'     => $args['address'],
                'email'       => $args['email'],          
                'active'      => 1
            ];

        }


        

        $provider = Provider::create($data);

        return $provider;


    }
}
