<?php

namespace Lisa18\LaravelShop\Extend\Artisan;

use Illuminate\Support\ServiceProvider;

class ArtisanServiceProvider extends ServiceProvider
{

    protected $command = [];

    public function register()
    {
        $this->commands($this->command);
    }

    public function boot()
    {

    }
}
?>