<?php

namespace App\GraphQL\Mutations\Auth;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshTokenMutation extends Mutation
{
   protected $attributes = [
      'name' => 'refreshToken',
      'description' => 'Atualiza o token JWT de um usuário autenticado',
   ];

   public function type(): Type
   {
      return GraphQL::type('LoginResponse');
   }

   public function authorize($root, array $args, $ctx, ?\GraphQL\Type\Definition\ResolveInfo $resolveInfo = null, ?\Closure $getSelectFields = null): bool
   {
      return Auth::guard('api')->check();
   }

   public function resolve($root, array $args)
   {
      $token = Auth::guard('api')->refresh();

      return [
         'status' => true,
         'message' => 'Token atualizado com sucesso!',
         'access_token' => $token,
         'token_type' => 'bearer',
         'expires_in' => JWTAuth::factory()->getTTL() * 60,
         'user' => Auth::guard('api')->user(),
      ];
   }
}
