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
         'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
         'price' => ['name' => 'price', 'type' => Type::nonNull(Type::float())],
         'description' => ['name' => 'description', 'type' => Type::string()],
      ];
   }

   public function authorize($root, array $args, $ctx, $info = null, $getSelectFields = null): bool
   {
      return Auth::check(); // 🔐 Apenas usuários autenticados
   }

   public function resolve($root, $args)
   {
      $user = Auth::user();

      return Product::create([
         'name' => $args['name'],
         'price' => $args['price'],
         'description' => $args['description'] ?? null,
         'user_id' => $user->id,
      ]);
   }
}
