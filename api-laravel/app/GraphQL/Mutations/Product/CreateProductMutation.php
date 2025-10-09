<?php

namespace App\GraphQL\Mutations\Product;

use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use App\Models\Product;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Auth;

class CreateProductMutation extends Mutation
{
   protected $attributes = [
      'name' => 'createProduct',
      'description' => 'Cria um novo produto (somente autenticado)',
   ];

   public function type(): Type
   {
      return GraphQL::type('Product');
   }

   public function args(): array
   {
      return [
         'name' => ['type' => Type::nonNull(Type::string())],
         'description' => ['type' => Type::string()],
         'price' => ['type' => Type::nonNull(Type::float())],
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

      return Product::create([
         'name' => $args['name'],
         'description' => $args['description'] ?? null,
         'price' => $args['price'],
         'stock' => $args['stock'] ?? 0,
      ]);
   }
}
