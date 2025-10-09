<?php

namespace App\GraphQL\Queries\Auth;

use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\UserType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Auth;

class MeQuery extends Query
{
   protected $attributes = [
      'name' => 'me',
      'description' => 'Retorna o usuário autenticado'
   ];

   public function type(): Type
   {
      return GraphQL::type('User');
   }

   public function authorize($root, array $args, $ctx, $info = null, $getSelectFields = null): bool
   {
      return Auth::check();
   }

   public function resolve($root, $args)
   {
      return Auth::user();
   }
}
