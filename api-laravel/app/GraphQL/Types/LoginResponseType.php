<?php

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class LoginResponseType extends GraphQLType
{
   protected $attributes = [
      'name' => 'LoginResponse',
      'description' => 'Resposta do login JWT',
   ];

   public function fields(): array
   {
      return [
         'status' => [
            'type' => Type::boolean(),
            'description' => 'Se o login foi bem-sucedido',
         ],
         'message' => [
            'type' => Type::string(),
            'description' => 'Mensagem de status',
         ],
         'access_token' => [
            'type' => Type::string(),
            'description' => 'Token JWT de acesso',
         ],
         'token_type' => [
            'type' => Type::string(),
            'description' => 'Tipo de token, geralmente Bearer',
         ],
         'expires_in' => [
            'type' => Type::int(),
            'description' => 'Tempo até a expiração, em segundos',
         ],
         'user' => [
            'type' => GraphQL::type('User'),
            'description' => 'Dados do usuário autenticado',
         ],
      ];
   }
}
