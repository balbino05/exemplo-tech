<?php

namespace App\GraphQL\Resolvers;

use App\Services\ProductService;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ProductResolver
{
   public function __construct(private ProductService $service) {}
   public function all($root, array $args, GraphQLContext $ctx)
   {
      return $this->service->paginate(50);
   }
   public function find($root, array $args)
   {
      return $this->service->find($args['id']);
   }
   public function create($root, array $args)
   {
      return $this->service->createProduct($args['input']);
   }
}
