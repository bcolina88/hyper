<?php

namespace App\GraphQL\Type;

//use GraphQL\Type\Definition\Type;
//use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use App\Models\Car;
use App\Models\ModelCar;
use App\Models\TypeCar;

class CarPhotoType extends BaseType
{
    protected $attributes = [
        'name' => 'CarPhoto',
        'description' => 'A Car'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'type' => [
                'type' => Type::nonNull(Type::string())
            ],
            'color' => [
                'type' => Type::nonNull(Type::string())
            ],
            'confort' => [
                'type' => Type::nonNull(Type::string())
            ],
            'upholstery' => [
                'type' => Type::nonNull(Type::string())
            ],
            'paintState' => [
                'type' => Type::nonNull(Type::string())
            ],
            'year' => [
                'type' => Type::nonNull(Type::string())
            ],
            'registrationDate' => [
                'type' => Type::nonNull(Type::string())
            ],
            'lastCheckDate' => [
                'type' => Type::nonNull(Type::string())
            ],
            'status' => [
                'type' => Type::nonNull(Type::string())
            ],
            'vehicleStatus' => [
                'type' => Type::nonNull(Type::string())
            ],
            'travelOtherStates' => [
                'type' => Type::nonNull(Type::string())
            ],
            'photos' => [
                'type' => Type::nonNull(Type::string())
            ],
            'plateNumber' => [
                'type' => Type::nonNull(Type::string())
            ],
            'circulationCertificate' => [
                'type' => Type::nonNull(Type::string())
            ],
            'propertyTitle' => [
                'type' => Type::nonNull(Type::string())
            ],
            'serialCar' => [
                'type' => Type::nonNull(Type::string())
            ],
            'armoredLevel' => [
                'type' => Type::nonNull(Type::int())
            ],
            'airConditioning' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'armored' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'lateralMirrors' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'rearViewMirror' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'frontLights' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'taillights' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'blinkingLights' => [
                'type' => Type::nonNull(Type::boolean())
            ],
            'rubbersState' => [
                'type' => Type::nonNull(Type::string())
            ],
            'photos' => [
                'type' => Type::listOf(GraphQL::type('UploadCar'))
            ],
            'model' => [
                'type' => GraphQL::type('ModelCar')
            ],
            'typeCar' => [
                'type' => GraphQL::type('TypeCar')
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string())
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string())
            ]
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
