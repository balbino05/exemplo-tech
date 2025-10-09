<?php

namespace App\GraphQL\Mutations\Auth;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Auth;

class LogoutMutation extends Mutation
{
   protected $attributes = [
      'name' => 'logout',
      'description' => 'Efetua o logout do usuário autenticado',
   ];

   public function type(): Type
   {
      return Type::boolean();
   }

   public function authorize($root, array $args, $ctx, ?\GraphQL\Type\Definition\ResolveInfo $resolveInfo = null, ?\Closure $getSelectFields = null): bool
   {
      return Auth::guard('api')->check();
   }

   public function resolve($root, array $args)
   {
      Auth::guard('api')->logout();
      return true;
   }
}
