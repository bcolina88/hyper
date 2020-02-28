<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\Rating;

class RatingType extends BaseType
{
    protected $attributes = [
        'name' => 'Rating',
        'description' => 'A rating',
        'model'       => Rating::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'assessment1' => [
                'type' => Type::int()
            ],
            'assessment2' => [
                'type' => Type::int()
            ],
            'assessment3' => [
                'type' => Type::int()
            ],
            'observations' => [
                'type' => Type::string()
            ],
            'total' => [
                'type' => Type::string()
            ],
            'assessmentDriver' => [
                'type' => Type::string()
            ],
            'rider' => [
                'type' =>  GraphQL::type('Rider')
            ],
            'driver' => [
                'type' =>  GraphQL::type('Driver')
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->toDateTimeString();
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at->toDateTimeString();
    }
}
