<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL;

class CreateProductMutation extends Mutation
{
   protected $attributes = [
      'name' => 'createProduct',
      'description' => 'Cria um novo produto no sistema',
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
         'stock' => ['type' => Type::nonNull(Type::int())],
      ];
   }

   public function rules(array $args = []): array
   {
      return [
         'name' => ['required', 'max:255'],
         'price' => ['required', 'numeric', 'min:0'],
         'stock' => ['required', 'integer', 'min:0'],
      ];
   }

   public function resolve($root, $args)
   {
      return Product::create([
         'name' => $args['name'],
         'description' => $args['description'] ?? null,
         'price' => $args['price'],
         'stock' => $args['stock'],
      ]);
   }
}
