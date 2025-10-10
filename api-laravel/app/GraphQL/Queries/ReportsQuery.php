<?php

namespace App\GraphQL\Queries;

use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\ReportService;

class ReportsQuery extends Query
{
   protected $attributes = [
      'name' => 'reports',
      'description' => 'Retorna relatórios gerados pelos microserviços Go e Python',
   ];

   public function type(): Type
   {
      return GraphQL::type('Report');
   }

   public function resolve($root, $args, ReportService $service)
   {
      return [
         'products' => $service->generateProductReport(),
         'analytics' => $service->generateAnalytics(),
      ];
   }
}
