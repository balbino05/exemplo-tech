<?php

declare(strict_types=1);

namespace App\Consumer;

use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Message\Type;
use App\Service\ReportProcessor;

#[Consumer(exchange: "reports.exchange", routingKey: "reports.generate", queue: "reports.queue", name: "ReportConsumer", nums: 5)]
class ReportConsumer extends ConsumerMessage
{
   public string $type = Type::DIRECT;

   public function __construct(private ReportProcessor $processor) {}

   public function consume($data, $message): string
   {
      $this->processor->process($data);
      return self::ACK;
   }
}
