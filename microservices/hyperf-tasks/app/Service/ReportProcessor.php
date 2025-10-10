<?php

namespace App\Service;

use Hyperf\Coroutine\Parallel;
use Hyperf\Context\ApplicationContext;
use Psr\Log\LoggerInterface;

class ReportProcessor
{
   public function process(array $payload): void
   {
      $logger = ApplicationContext::getContainer()->get(LoggerInterface::class);
      $logger->info("Processing report", $payload);

      // Executa múltiplas tarefas simultâneas
      $parallel = new Parallel(4);
      $parallel->add(fn() => $this->generateCharts($payload));
      $parallel->add(fn() => $this->analyzeData($payload));
      $parallel->add(fn() => $this->sendWebhook($payload));

      $parallel->wait();
   }

   private function generateCharts(array $data): void
   {
      sleep(1); // simula operação pesada
   }

   private function analyzeData(array $data): void
   {
      sleep(1);
   }

   private function sendWebhook(array $data): void
   {
      // envia notificação para outro serviço
   }
}
