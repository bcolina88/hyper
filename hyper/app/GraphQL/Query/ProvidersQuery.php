<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Models\Provider;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use JWTAuth;

class ProvidersQuery extends Query {

    protected $attributes = [
        'name' => 'providers',
        'description' => 'Providers list.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('ProviderType'));
    }

    public function args()
    {
        
    }

    public function resolve($root, $args)
    {
        /*try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
            throw new \Exception("Unauthorized", 403);
        }*/
       
        $providers = Provider::all();
        return $providers;
    }
}