<?php

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL as GraphQLFacade;

class ProductPaginationType extends GraphQLType
{
   protected $attributes = [
      'name' => 'ProductPagination',
      'description' => 'Resultado paginado de produtos',
   ];

   public function fields(): array
   {
      return [
         'data' => [
            'type' => Type::listOf(GraphQLFacade::type('Product')),
            'description' => 'Itens da página',
         ],
         'paginatorInfo' => [
            'type' => GraphQLFacade::type('PaginatorInfo'),
            'description' => 'Metadados de paginação',
         ],
      ];
   }
}
