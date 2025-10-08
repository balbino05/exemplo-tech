<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductService
{
   public function __construct(private ProductRepositoryInterface $repo) {}

   public function createProduct(array $data)
   {
      return DB::transaction(fn() => $this->repo->create($data));
   }

   public function paginate($perPage = 15)
   {
      return $this->repo->paginate($perPage);
   }

   public function find($id)
   {
      return $this->repo->find($id);
   }
}
