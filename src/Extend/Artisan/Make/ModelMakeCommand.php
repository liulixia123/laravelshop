<?php
namespace Lisa18\LaravelShop\Extend\Artisan\Make;

use Illuminate\Foundation\Console\ModelMakeCommand as Commad;
use Illuminate\Support\Str;

class ModelMakeCommand extends Commad
{
    // trait 方法的优先级大于继承
    use GeneratorCommand;
    protected $name = 'shop-make:model';
    //创建模型文件位置根据命名空间
    /*protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\'.$this->getPackageInput().'\Models';
    }*/

    protected $defaultNamespace = "\Models";

    //产生数据库迁移文件
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));
        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }
        $this->call('shop-make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
            '--path' => $this->getPackageInput()
        ]);
    }
}
?>