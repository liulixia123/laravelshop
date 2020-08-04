<?php
namespace Lisa18\LaravelShop\Extend\Swoole\Facades;

use Illuminate\Support\Facades\Facade;

class SwooleServer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'extend.swoole_server';
    }
}