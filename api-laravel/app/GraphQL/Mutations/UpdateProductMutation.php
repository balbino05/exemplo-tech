<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL;

class UpdateProductMutation extends Mutation
{
   protected $attributes = [
      'name' => 'updateProduct',
      'description' => 'Atualiza informações de um produto existente',
   ];

   public function type(): Type
   {
      return GraphQL::type('Product');
   }

   public function args(): array
   {
      return [
         'id' => ['type' => Type::nonNull(Type::id())],
         'name' => ['type' => Type::string()],
         'description' => ['type' => Type::string()],
         'price' => ['type' => Type::float()],
         'stock' => ['type' => Type::int()],
      ];
   }

   public function rules(array $args = []): array
   {
      return [
         'id' => ['required', 'exists:products,id'],
         'price' => ['nullable', 'numeric', 'min:0'],
         'stock' => ['nullable', 'integer', 'min:0'],
      ];
   }

   public function resolve($root, $args)
   {
      $product = Product::findOrFail($args['id']);
      $product->fill(collect($args)->except('id')->toArray());
      $product->save();

      return $product;
   }
}
