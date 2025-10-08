<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
   protected $service;

   public function __construct(ProductService $service)
   {
      $this->service = $service;
   }

   public function index(): JsonResponse
   {
      $products = $this->service->listProducts();
      return response()->json($products);
   }
}
