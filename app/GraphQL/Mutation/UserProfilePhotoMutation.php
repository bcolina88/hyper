<?php

namespace App\GraphQL\Mutation;

use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Upload\UploadType;


class UserProfilePhotoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UserProfilePhotoMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('StringType');
    }

    public function args(): array
    {
        return [
            'profilePicture' => [
                'name' => 'profilePicture',
                'type' => new UploadType(),
                'rules' => ['required', 'image', 'max:1500'],
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $file = $args['profilePicture'];

        $file->moveTo('some/folder/in/my/project');

        $token = 'Uploaded file was ' . $file->getClientFilename() . ' (' . $file->getClientMediaType() . ') with description: ' . 'prueba';

        return compact('token');
        // Do something with file here...
    }
}