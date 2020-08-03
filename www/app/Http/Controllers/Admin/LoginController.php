<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
class LoginController extends Controller
{
    /*
     * 登录页面
     */
    public function log()
    {
        return view("login.log");
    }

    public function reg()
    {
        return view("login.reg");
    }

    public function setting()
    {
        return view("login.setting");
    }

    public function index()
    {
        $zuixi = GoodsModel::orderby('add_time', 'desc')->take(10)->get();
        $pagSize = config('app.pageSize');
        $remai = GoodsModel::orderby('click_count', 'desc')->paginate(4);
        return view('login.index', ['zuixi' => $zuixi, 'remai' => $remai]);
    }
    //return view("login.index");
}