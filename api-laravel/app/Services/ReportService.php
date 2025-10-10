<?php

namespace App\Services;

use App\Helpers\HttpClient;

class ReportService
{
   protected HttpClient $client;

   public function __construct(HttpClient $client)
   {
      $this->client = $client;
   }

   public function generateProductReport(): array
   {
      return $this->client->get('http://go_service:8082/reports/generate?type=products');
   }

   public function generateAnalytics(): array
   {
      return $this->client->get('http://python_service:8083/tasks/run?job=analyze_sales');
   }
}
