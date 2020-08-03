<?php
namespace Lisa18\LaravelShop\Extend\Swoole;

use Illuminate\Support\ServiceProvider;

class SwooleServiceProvider extends ServiceProvider{
    protected $command = [
        Console\HttpServerCammand::class
    ];

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/swoole.php', 'extend.swoole'
        );
        $this->commands($this->command);
    }

    public function boot()
    {
    }
}