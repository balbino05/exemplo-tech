<?php

namespace App\GraphQL\Types;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
   protected $attributes = [
      'name' => 'Product',
      'description' => 'A product',
      'model' => Product::class,
   ];

   public function fields(): array
   {
      return [
         'id' => [
            'type' => Type::nonNull(Type::int()),
         ],
         'name' => [
            'type' => Type::nonNull(Type::string()),
         ],
         'description' => [
            'type' => Type::string(),
         ],
         'price' => [
            'type' => Type::nonNull(Type::float()),
         ],
         'stock' => [
            'type' => Type::nonNull(Type::int()),
         ],
      ];
   }
}
