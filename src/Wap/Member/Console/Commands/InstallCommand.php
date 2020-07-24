<?php
namespace Lisa18\LaravelShop\Wap\Member\Console\Commands;
use Illuminate\Console\Command;
class InstallCommand extends Command{
    // 命令的名称
    protected $signature = 'wap-member:install';
    // 命令的解释
    protected $description = '这个是wap下的member组件安装命令';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // call
        $this->call('migrate');
        /*$this->call('vendor:publish', [
          // 参数表示 => 参数值
          "--provider"=>"Lisa18\LaravelShop\Wap\Member\Providers\MemberServiceProvider"
        ]);*/
        // echo '这是测试wap-member的安装命令';
    }
}
?>