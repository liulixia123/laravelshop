<?php
namespace Lisa18\LaravelShop\Extend\Swoole;

use Lisa18\LaravelShop\Extend\Swoole\Server\Manager;

use Swoole\Http\Server as HttpSwooleServer;
use Swoole\WebSocket\Server as WebSocketSwooleServer;
use Illuminate\Support\ServiceProvider;

class SwooleServiceProvider extends ServiceProvider{
    protected static $server;
    protected $command = [
        Console\HttpServerCammand::class
    ];

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/swoole.php', 'extend.swoole'
        );
        $this->commands($this->command);
        $this->registerSwooleServer();
        $this->registerSwooleManager();
    }

    public function boot()
    {
    }
    /**
     * 注册swoole的服务
     */
    public function registerSwooleManager()
    {
        $this->app->singleton('extend.swoole_manager', function($app){
            return new Manager($app);
        });
    }
    /**
     * 注册swoole的服务
     */
    protected function registerSwooleServer()
    {
        $this->app->singleton('extend.swoole_server', function (){
            // 1. 获取配置
            // 2. 确定创建的服务
            // 3. 创建swoole
            // 可以写成方法
            if (is_null(static::$server)) {
                // 创建swoole服务
                $this->createSwooleServer();
                // 添加swoole服务配置
                $this->configureSwooleServer();
            }
            return static::$server;
        });
    }
    // 此方法懒得完善
    protected function configureSwooleServer()
    {
        // .. 跳过
        $swoole_config = config('extend.swoole.socket_type') ? config('extend.swoole.http') : config('extend.swoole.websocket');
        // static::$server->set($swoole_config);
    }
    protected function createSwooleServer()
    {
        $server = config('extend.swoole.socket_type') ? HttpSwooleServer::class : WebSocketSwooleServer::class ;
        static::$server = new $server(config('extend.swoole.listen.ip'), config('extend.swoole.listen.port'));
    }
    
}