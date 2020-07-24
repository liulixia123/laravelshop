<?php
namespace Lisa18\LaravelShop\Wap\Member\Http\Controllers;

use Illuminate\Http\Request;
use Lisa18\LaravelShop\Wap\Member\Models\User;
// use Illuminate\Support\Facades\Auth;
use Lisa18\LaravelShop\Wap\Member\Http\Controllers\Controller;
class AuthorizationsController extends Controller
{
    public function wechatStore(Request $request)
    {
        // 获取微信的用户信息
        $wechatUser = session('wechat.oauth_user.default');
        $user = User::where("weixin_openid", $wechatUser->id)->first();
        if (!$user) {
            // 不存在记录用户信息
            $user = User::create([
                "nickname"      => $wechatUser->name,
                "weixin_openid" => $wechatUser->id,
                "image_head"    => $wechatUser->avatar
            ]);
        }
        // 登入状态->改变
        // 迁移性的问
        // 改变用户的状态设置为登入
        // 难得点
        return "通过";
        //return redirect()->route('wap.member.index');
    }
}
?>