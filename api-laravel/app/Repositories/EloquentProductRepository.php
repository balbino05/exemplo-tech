<?php

namespace App\Repositories;

use App\Models\Product;

class EloquentProductRepository implements ProductRepositoryInterface
{
   public function find(int $id): ?Product
   {
      return Product::find($id);
   }
   public function paginate(int $perPage = 15)
   {
      return Product::paginate($perPage);
   }
   public function create(array $data): Product
   {
      return Product::create($data);
   }
   public function update(int $id, array $data): bool
   {
      $p = $this->find($id);
      return $p ? $p->update($data) : false;
   }
   public function delete(int $id): bool
   {
      $p = $this->find($id);
      return $p ? (bool)$p->delete() : false;
   }
}
