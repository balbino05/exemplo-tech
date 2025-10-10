<?php
return [
   'default' => [
      'host' => env('RABBITMQ_HOST', 'rabbitmq'),
      'port' => (int)env('RABBITMQ_PORT', 5672),
      'user' => env('RABBITMQ_USER', 'guest'),
      'password' => env('RABBITMQ_PASS', 'guest'),
      'vhost' => '/',
      'pool' => [
         'min_connections' => 1,
         'max_connections' => 10,
         'connect_timeout' => 5.0,
         'wait_timeout' => 3.0,
         'heartbeat' => 30,
      ],
      'params' => [
         'insist' => false,
         'login_method' => 'AMQPLAIN',
         'locale' => 'en_US',
         'connection_timeout' => 3.0,
         'read_write_timeout' => 6.0,
      ],
   ],
];
