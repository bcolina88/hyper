<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;

class BooleanType extends BaseType
{
   
    protected $attributes = [
        'name' => 'BooleanType',
        'description' => 'Boolean type.'
    ];
    
    public function fields()
    {
        return [
            'isUser' => [
                'type' => Type::string()
            ]
        ];
    }

}