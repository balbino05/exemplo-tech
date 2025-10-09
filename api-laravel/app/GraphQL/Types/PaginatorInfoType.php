<?php

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class PaginatorInfoType extends GraphQLType
{
   protected $attributes = [
      'name' => 'PaginatorInfo',
      'description' => 'Metadados de paginação',
   ];

   public function fields(): array
   {
      return [
         'total' => ['type' => Type::int()],
         'count' => ['type' => Type::int()],
         'perPage' => ['type' => Type::int()],
         'currentPage' => ['type' => Type::int()],
         'lastPage' => ['type' => Type::int()],
         'hasMorePages' => ['type' => Type::boolean()],
      ];
   }
}
