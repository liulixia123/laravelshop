<?php

namespace Lisa18\LaravelShop\Extend\Artisan\Make;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class ClassMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:class';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'laravel-shop make class';

    protected $type = 'Class';

    protected function getStub()
    {
        return __DIR__.'/stubs/class.stub';
    }

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
