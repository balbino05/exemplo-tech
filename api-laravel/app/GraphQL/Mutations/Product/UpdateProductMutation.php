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
         'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
         'name' => ['name' => 'name', 'type' => Type::string()],
         'price' => ['name' => 'price', 'type' => Type::float()],
         'description' => ['name' => 'description', 'type' => Type::string()],
      ];
   }

   public function authorize($root, array $args, $ctx, $info = null, $getSelectFields = null): bool
   {
      return Auth::check();
   }

   public function resolve($root, $args)
   {
      $product = Product::findOrFail($args['id']);
      $product->update($args);
      return $product;
   }
}
