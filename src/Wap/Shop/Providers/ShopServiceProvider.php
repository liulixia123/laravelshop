<?php

namespace Lisa18\LaravelShop\Wap\Shop\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ShopServiceProvider extends ServiceProvider
{
    public function register()
    {
    	 // 注册配置文件
        $this->mergeConfigFrom(  __DIR__.'/../Config/shop.php', 'wap.shop');
    	$this->registerRoutes();
    	$this->registerPublishing();
    }

    public function boot()
    {
    	//加载视图
    	$this->loadViewsFrom(
            __DIR__.'/../Resources/views', 'wap.shop'
        );
    }
     // 加载路由
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../Routes/shop.php');
        });
    }
    protected function routeConfiguration()
    {
        return [
            'namespace'  => 'Lisa18\LaravelShop\Wap\Shop\Http\Controllers',
            'prefix'     => 'wap/shop',
            'middleware' => 'web'
        ];
    }
    // 发布文件
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../Resources/assets' => public_path('vendor/lisa18/laravel-wap-shop'),
            ], 'wap-shop');
        }
    }
}

// ---