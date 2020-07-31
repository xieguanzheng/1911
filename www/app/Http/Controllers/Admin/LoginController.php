<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function setting(){
        return view("login.setting");
    }
}