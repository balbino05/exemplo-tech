<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
   public function getAll()
   {
      return Product::all();
   }

   public function all()
   {
      return Product::paginate(10);
   }

   public function find($id)
   {
      return Product::find($id);
   }

   public function create(array $data)
   {
      return Product::create($data);
   }

   public function update(Product $product, array $data): Product
   {
      $product->update($data);
      return $product;
   }

   public function delete(Product $product): bool
   {
      return $product->delete();
   }
}
