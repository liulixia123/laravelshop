<?php
if (! function_exists('shop_asset')) {
    function shop_asset($path, $secure = null)
    {
        return app('url')->asset("vendor\lisa18\laravel-wap-shop\\".$path, $secure);
    }
}
?>