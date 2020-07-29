<?php
namespace Lisa18\LaravelShop\Wap\Shop\Http\Controllers;

use Lisa18\LaravelShop\Wap\Shop\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WechatMenuController extends Controller
{
    public function index()
    {
        return app('wechat.official_account')->menu->create(config('wap.shop.wechat.buttons'));
    }
}
?>