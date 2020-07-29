<?php
namespace Lisa18\LaravelShop\Wap\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Lisa18\LaravelShop\Wap\Shop\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('wap.shop::index.index');
    }
}