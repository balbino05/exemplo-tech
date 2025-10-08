<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
   public function getAll()
   {
      return Product::all();
   }

   public function find($id)
   {
      return Product::find($id);
   }

   public function create(array $data)
   {
      return Product::create($data);
   }
}
