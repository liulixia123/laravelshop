<?php
namespace Lisa18\LaravelShop\Extend\Swoole\Server;

use Illuminate\Contracts\Container\Container;
use Lisa18\LaravelShop\Extend\Swoole\Http\SRequest;
use Lisa18\LaravelShop\Extend\Swoole\Http\SResponse;

class Manager{
	/**
     * 保存swoole服务
     * @var \Swoole\Http\Server | \Swoole\WebSocket\Server
     */
    protected $server;

    /**
     * laravel的应用程序Application
     * @var [type]
     */
    protected $laravel;
    /**
     * swoole事件
     * @var [type]
     */
    protected $events = [
        'request' => 'onRequest',
        'start'   => 'onStart'
        // 其他的事件相关的可以看swoole的官网..
    ];

    public function __construct(Container $laravel )
    {
        $this->laravel = $laravel;
        // ... 获取swoole的服务
        $this->server = $this->laravel->make('extend.swoole_server');
        // ... 设置swoole的监听函数
        $this->setSwooleServerEvent();
    }
    protected function setSwooleServerEvent()
    {
        // .. 判断类型
        $type = config('extend.swoole.socket_type') ? 'http' : 'websocket';
        // var_dump($type);
        foreach ($this->events[$type] as $event => $func) {
            $this->server->on($event, [$this, $func]);
        }
    }
    /**
     * 'onRequest' event
     * @param  \Swoole\Http\Request $swooleRequest
     * @param  \Swoole\Http\Response $swooleResponse
     */
    protected function onRequest($swooleRequest, $swooleResponse){
    	try {
            $laravelRequest = SRequest::make($swooleRequest);
            // var_dump();
            $laravelResponse = $this->laravel->make(\Illuminate\Contracts\Http\Kernel::class)->handle($laravelRequest);
            // $swooleResponse->header("Content-Type", "text/html; charset=utf-8");
            // // 页面渲染
            SResponse::make($laravelResponse, $swooleResponse)->send();
            // $swooleResponse->end($laravelResponse->getContent());
        } catch (\Exception $e) {
            $swooleResponse->end($e);
        }

    }

    protected function onStart() {
    	$this->server->start();
    }
}