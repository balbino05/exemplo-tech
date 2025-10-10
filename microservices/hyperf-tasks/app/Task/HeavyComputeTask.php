<?php

namespace App\Task;

use Hyperf\Task\Annotation\Task;
use Hyperf\Task\TaskExecutor;

#[Task]
class HeavyComputeTask
{
   public function handle(array $data)
   {
      // processamento pesado com paralelismo
      $sum = 0;
      foreach ($data as $v) $sum += $v;
      return $sum;
   }
}
