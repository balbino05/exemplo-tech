<?php

namespace App\GraphQL\Mutations\Auth;

use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginMutation extends Mutation
{
   protected $attributes = [
      'name' => 'login',
      'description' => 'Realiza login do usuário e retorna o token JWT',
   ];

   public function type(): Type
   {
      return GraphQL::type('LoginResponse');
   }

   public function args(): array
   {
      return [
         'email' => [
            'type' => Type::nonNull(Type::string()),
         ],
         'password' => [
            'type' => Type::nonNull(Type::string()),
         ],
      ];
   }

   public function resolve($root, $args)
   {
      if (! $token = Auth::guard('api')->attempt($args)) {
         return [
            'status' => false,
            'message' => 'Credenciais inválidas',
            'access_token' => null,
            'user' => null,
         ];
      }

      return [
         'status' => true,
         'message' => 'Login realizado com sucesso',
         'access_token' => $token,
         'token_type' => 'Bearer',
         'expires_in' => JWTAuth::factory()->getTTL() * 60,
         'user' => Auth::guard('api')->user(),
      ];
   }
}
