<?php

namespace App\GraphQL\Mutations\Auth;

use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

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
            'description' => 'E-mail do usuário',
         ],
         'password' => [
            'type' => Type::nonNull(Type::string()),
            'description' => 'Senha do usuário',
         ],
      ];
   }

   public function resolve($root, $args)
   {
      try {
         $credentials = [
            'email' => $args['email'],
            'password' => $args['password'],
         ];

         if (! $token = Auth::guard('api')->attempt($credentials)) {
            return [
               'status' => false,
               'message' => 'Credenciais inválidas',
               'access_token' => null,
               'token_type' => null,
               'expires_in' => null,
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
      } catch (Exception $e) {
         return [
            'status' => false,
            'message' => 'Erro interno ao tentar autenticar: ' . $e->getMessage(),
            'access_token' => null,
            'token_type' => null,
            'expires_in' => null,
            'user' => null,
         ];
      }
   }
}
