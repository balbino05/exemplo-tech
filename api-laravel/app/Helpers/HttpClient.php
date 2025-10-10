<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class HttpClient
{
   public function get(string $url): array
   {
      $response = Http::timeout(30)->get($url);
      return $response->json();
   }

   public function post(string $url, array $payload = []): array
   {
      $response = Http::timeout(30)->post($url, $payload);
      return $response->json();
   }
}
