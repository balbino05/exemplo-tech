<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
   /**
    * A basic test example.
    */
   public function test_create_product_calls_repository()
   {
      $repoMock = \Mockery::mock(\App\Repositories\ProductRepositoryInterface::class);
      $repoMock->shouldReceive('create')->once()->with(\Mockery::type('array'))->andReturn(new \App\Models\Product(['id' => 1, 'name' => 'x']));
      $service = new \App\Services\ProductService($repoMock);
      $product = $service->createProduct(['name' => 'x', 'price' => 10, 'stock' => 1]);
      $this->assertEquals(1, $product->id);
   }
}
