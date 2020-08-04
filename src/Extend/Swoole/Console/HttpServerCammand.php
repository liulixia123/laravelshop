<?php
namespace Lisa18\LaravelShop\Extend\Swoole\Console;

use Illuminate\Console\Command;

class HttpServerCammand extends Command{
    protected $signature = 'extend:swoole {action : start|stop|restart|reload|infos}';

    protected $description = 'Command description';

    protected $manager;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
    	$this->manager = $this->laravel->make('extend.swoole_manager');
        //$this->info($this->execution());
        $this->execution();
    }
    protected function execution()
    {
        return $this->{$this->argument('action')}();
    }

    protected function start()
    {
        $this->manager->run();
        return 'start';
    }
    protected function stop()
    {
        return 'stop';
    }
    protected function restart()
    {
        return 'restart';
    }
    protected function reload()
    {
        return 'reload';
    }
    protected function infos()
    {
        return 'infos';
    }
}