<?php

namespace App\GraphQL\Mutations\Product;

use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class DeleteProductMutation extends Mutation
{
   protected $attributes = [
      'name' => 'deleteProduct',
      'description' => 'Exclui um produto existente (somente autenticado)',
   ];

   public function type(): Type
   {
      return Type::boolean();
   }

   public function args(): array
   {
      return [
         'id' => ['type' => Type::nonNull(Type::int())],
      ];
   }

   public function authorize($root, array $args, $ctx, ?\GraphQL\Type\Definition\ResolveInfo $info = null, ?\Closure $getSelectFields = null): bool
   {
      return Auth::guard('api')->check();
   }

   public function resolve($root, $args)
   {
      $user = Auth::guard('api')->user();

      if (! $user) {
         throw new \Exception('Unauthorized');
      }

      $product = Product::find($args['id']);

      if (! $product) {
         throw new \Exception('Produto não encontrado');
      }

      return $product->delete();
   }
}
