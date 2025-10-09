<?php

namespace App\GraphQL\Mutations\Auth;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterMutation extends Mutation
{
   protected $attributes = [
      'name' => 'register',
      'description' => 'Registra um novo usuário e retorna o token JWT',
   ];

   public function type(): Type
   {
      return GraphQL::type('LoginResponse');
   }

   public function args(): array
   {
      return [
         'name' => ['type' => Type::nonNull(Type::string())],
         'email' => ['type' => Type::nonNull(Type::string())],
         'password' => ['type' => Type::nonNull(Type::string())],
      ];
   }

   public function resolve($root, array $args)
   {
      $validator = Validator::make($args, [
         'name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:users',
         'password' => 'required|string|min:6',
      ]);

      if ($validator->fails()) {
         return [
            'status' => false,
            'message' => $validator->errors()->first(),
            'access_token' => null,
            'user' => null,
         ];
      }

      $user = User::create([
         'name' => $args['name'],
         'email' => $args['email'],
         'password' => Hash::make($args['password']),
      ]);

      $token = auth('api')->login($user);

      return [
         'status' => true,
         'message' => 'Usuário registrado com sucesso!',
         'access_token' => $token,
         'token_type' => 'bearer',
         'expires_in' => JWTAuth::factory()->getTTL() * 60,
         'user' => $user,
      ];
   }
}
