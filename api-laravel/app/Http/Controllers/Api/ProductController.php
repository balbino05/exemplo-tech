<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function __construct(private ProductService $service) {}

   public function index()
   {
      return response()->json($this->service->paginate(15));
   }

   public function store(Request $r)
   {
      $data = $r->validate(['name' => 'required', 'price' => 'required|numeric', 'stock' => 'integer']);
      return response()->json($this->service->createProduct($data), 201);
   }
   public function show($id)
   {
      return response()->json($this->service->find($id));
   }
   // update, destroy -> similares
}
