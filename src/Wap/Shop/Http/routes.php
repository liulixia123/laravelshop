<?php
Route::get('/','IndexController@index');
Route::get('/wechat-menu', 'WechatMenuController@index');
/*Route::get('/', function () {
    dd(shop_asset('css/1.css'));
});*/
?>