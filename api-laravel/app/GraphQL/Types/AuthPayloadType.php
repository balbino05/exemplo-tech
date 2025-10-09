<?php

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AuthPayloadType extends GraphQLType
{
   protected $attributes = ['name' => 'AuthPayload'];

   public function fields(): array
   {
      return [
         'access_token' => ['type' => Type::string()],
         'user' => ['type' => GraphQL::type('User')],
      ];
   }
}
