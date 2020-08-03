<?php
return [
    'listen'                => [
        'ip'   => env('SWOOLE_LISTEN_IP', '127.0.0.1'),
        'port' => env('SWOOLE_LISTEN_PORT', 9501)
    ],
];
