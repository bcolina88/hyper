<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Models\Provider;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class ProviderQuery extends Query
{
    protected $attributes = [
        'name' => 'Provider',
        'description' => 'Find an provider.'
    ];

    public function type()
    {
        return GraphQL::type('ProviderType');
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

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
        return Provider::find($args['id']);

    }
}
