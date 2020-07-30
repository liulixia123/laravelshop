<?php
namespace Lisa18\LaravelShop\Extend\Artisan\Make;

use Illuminate\Foundation\Console\ModelMakeCommand as Commad;
use Illuminate\Support\Str;

class ModelMakeCommand extends Commad
{
    use GeneratorCommand;
    protected $name = 'shop-make:model';
}
?>