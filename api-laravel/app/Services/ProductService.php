<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Log;
use Exception;

class ProductService
{
   protected $repository;

   public function __construct(ProductRepository $repository)
   {
      $this->repository = $repository;
   }

   public function listProducts()
   {
      return $this->repository->getAll();
   }

   public function list()
   {
      return $this->repository->all();
   }

   public function store(array $data)
   {
      try {
         return $this->repository->create($data);
      } catch (Exception $e) {
         Log::error('Erro ao criar produto', ['error' => $e->getMessage()]);
         throw $e;
      }
   }

   public function update(int $id, array $data)
   {
      $product = $this->repository->find($id);
      if (!$product) throw new Exception('Produto não encontrado');
      return $this->repository->update($product, $data);
   }

   public function delete(int $id)
   {
      $product = $this->repository->find($id);
      if (!$product) throw new Exception('Produto não encontrado');
      return $this->repository->delete($product);
   }
}
