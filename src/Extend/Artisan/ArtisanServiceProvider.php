<?php

namespace Lisa18\LaravelShop\Extend\Artisan;

use Illuminate\Support\ServiceProvider;

class ArtisanServiceProvider extends ServiceProvider
{

    // 这是命令的注册注册地点
    protected $command = [
        Make\ClassMakeCommand::class,
        Make\ModelMakeCommand::class,       
        Make\MigrateMakeCommand::class,       
    ];

    public function register()
    {
        $this->commands($this->command);
    }

    public function boot()
    {

    }
}
?>