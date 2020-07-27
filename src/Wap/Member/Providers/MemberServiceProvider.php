<?php
namespace Lisa18\LaravelShop\Wap\Member\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
class MemberServiceProvider extends ServiceProvider
{
    // member组件需要注入的中间件
    protected $routeMiddleware = [
         'wechat.oauth' => \Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class,
    ];
    //console命令组件
    protected $commands = [
        \Lisa18\LaravelShop\Wap\Member\Console\Commands\InstallCommand::class,
    ];
    protected $middlewareGroups = [];
    // 模仿
    public function register()
    {
        $this->registerRoutes();
         // 怎么加载config配置文件
        $this->mergeConfigFrom(__DIR__.'/../Config/member.php', "wap.member");
        // 怎么根据配置文件去加载auth信息
        $this->registerRouteMiddleware();
        //配置文件发布
        $this->registerPublishing();
    }
    public function boot()
    {
        //$this->loadMemberAuthConfig();
        $this->loadMemberConfig();
        $this->loadMigrations();
        $this->commands($this->commands);
    }
    protected function loadMemberAuthConfig()
    {
        config(Arr::dot(config('wap.member.auth', []), 'auth.'));
    }
    // 吧这个组件的auth信息合并到config的auth
    protected function loadMemberConfig()
    {
        // Arr 基础操方法封装
        // 这个数组合并之后，一定要再此保持laravel项目中
        config(Arr::dot(config('wap.member.wechat', []), 'wechat.'));
        config(Arr::dot(config('wap.member.auth', []), 'auth.'));
    }
    protected function registerRouteMiddleware()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }
    
    // 参考别人的写法
    // 对于源码熟悉更好一些
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
        });
    }

    private function routeConfiguration()
    {
        return [
            // 定义访问路由的域名
            // 'domain' => config('telescope.domain', null),
            // 是定义路由的命名空间
            'namespace' => 'Lisa18\LaravelShop\Wap\Member\Http\Controllers',
            // 这是前缀
            'prefix' => 'wap/member',
        ];
    }
    //加载数据库迁移
    public function loadMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        }
    }
    //配置文件发布
    public function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            //                  [当前组件的配置文件路径 =》 这个配置复制那个目录] , 文件标识
            // 1. 不填就是默认的地址 config_path 的路径 发布配置文件名不会改变
            // 2. 不带后缀就是一个文件夹
            // 3. 如果是一个后缀就是一个文件
            $this->publishes([__DIR__.'/../config' => config_path('wap')], 'laravel-shop-wap-member-config');
        }
    }
}
?>