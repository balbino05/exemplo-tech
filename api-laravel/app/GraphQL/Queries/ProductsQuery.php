<?php

namespace App\GraphQL\Queries;

use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL as GraphQLFacade;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductsQuery extends Query
{
   protected $attributes = [
      'name' => 'products',
      'description' => 'Lista paginada de produtos',
   ];

   public function type(): Type
   {
      return GraphQLFacade::type('ProductPagination');
   }

   public function args(): array
   {
      return [
         'page' => ['type' => Type::int(), 'defaultValue' => 1],
         'limit' => ['type' => Type::int(), 'defaultValue' => 12],
         'search' => ['type' => Type::string()],
      ];
   }

   // Para isolar o problema de tipos/paginação, deixe SEM auth por enquanto.
   // Depois reativamos a checagem do JWT.
   public function authorize($root, array $args, $ctx, $resolveInfo = null, $getSelectFields = null): bool
   {
      return Auth::guard('api')->check();
   }

   public function resolve($root, $args)
   {
      $q = Product::query();

      if (!empty($args['search'])) {
         $s = $args['search'];
         $q->where(function ($qq) use ($s) {
            $qq->where('name', 'like', "%{$s}%")
               ->orWhere('description', 'like', "%{$s}%");
         });
      }

      $limit = (int)($args['limit'] ?? 12);
      $page  = (int)($args['page'] ?? 1);

      $p = $q->orderBy('id', 'desc')->paginate($limit, ['*'], 'page', $page);

      return [
         'data' => $p->items(),
         'paginatorInfo' => [
            'total' => $p->total(),
            'count' => $p->count(),
            'perPage' => $p->perPage(),
            'currentPage' => $p->currentPage(),
            'lastPage' => $p->lastPage(),
            'hasMorePages' => $p->hasMorePages(),
         ],
      ];
   }
}
