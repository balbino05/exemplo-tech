<?php

namespace App\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
   public function find(int $id): ?Product;
   public function paginate(int $perPage = 15);
   public function create(array $data): Product;
   public function update(int $id, array $data): bool;
   public function delete(int $id): bool;
}
