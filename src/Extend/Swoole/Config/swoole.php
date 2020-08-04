<?php
return [
   'listen' => [
        'ip'   => env('SWOOLE_LISTEN_IP', '0.0.0.0'),
        'port' => env('SWOOLE_LISTEN_PORT', 9501)
    ],
    'socket_type' => true,
    'http' => [],
    'websocket'=>[]
];
