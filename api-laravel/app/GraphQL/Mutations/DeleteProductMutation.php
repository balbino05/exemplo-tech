<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteProductMutation extends Mutation
{
   protected $attributes = [
      'name' => 'deleteProduct',
      'description' => 'Exclui um produto pelo ID',
   ];

   public function type(): Type
   {
      return Type::boolean();
   }

   public function args(): array
   {
      return [
         'id' => ['type' => Type::nonNull(Type::id())],
      ];
   }

   public function rules(array $args = []): array
   {
      return [
         'id' => ['required', 'exists:products,id'],
      ];
   }

   public function resolve($root, $args)
   {
      $product = Product::findOrFail($args['id']);
      return (bool) $product->delete();
   }
}
