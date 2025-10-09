<?php

namespace App\GraphQL\Mutations\Product;

use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use App\Models\Product;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Auth;

class UpdateProductMutation extends Mutation
{
   protected $attributes = [
      'name' => 'updateProduct',
      'description' => 'Atualiza um produto existente (somente autenticado)',
   ];

   public function type(): Type
   {
      return GraphQL::type('Product');
   }

   public function args(): array
   {
      return [
         'id' => ['type' => Type::nonNull(Type::int())],
         'name' => ['type' => Type::string()],
         'description' => ['type' => Type::string()],
         'price' => ['type' => Type::float()],
         'stock' => ['type' => Type::int()],
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

      $product = Product::findOrFail($args['id']);

      $product->update([
         'name' => $args['name'] ?? $product->name,
         'description' => $args['description'] ?? $product->description,
         'price' => $args['price'] ?? $product->price,
         'stock' => $args['stock'] ?? $product->stock,
      ]);

      return $product;
   }
}
