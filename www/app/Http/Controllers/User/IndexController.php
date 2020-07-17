<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;

class IndexController extends Controller
{
    public function reg(Request $request)
    {
        $user_name = $request->post('user_name');
        $password = $request->post('password');
        $email = $request->post('email');
        $reg_time = time();
        if(empty($user_name)){
            $data = [
                'errno' => 00001,
                'msg'   => "用户名不能为空"
            ];
            return $data;
        }
        if(empty($password)){
            $data = [
                'errno' => 00002,
                'msg'   => "密码不能为空"
            ];
            return $data;
        }
        if(empty($email)){
            $data = [
                'errno'  =>  00003,
                'msg'    =>  "Email不能为空"
            ];
            return $data;
        }
        $user = new user();
        $user ->user_name =$user_name;
        $user ->password  = md5($password);
        $user ->email =$email;
        $user ->reg_time=$reg_time;
        $add =$user->save();
        if($add){
            $data = [
                'errno'  =>  00004,
                'msg'    =>  "添加成功"
            ];
            return $data;
        }else{
            $data = [
                'errno'  =>  00004,
                'msg'    =>  "添加失败"
            ];
            return $data;
        }
    }
    public function login(Request $request)
    {
        $user_name = $request->post('user_name');
        $password = md5($request->post('password'));
        if(empty($user_name)){
            $data = [
                'errno' => 00001,
                'msg'   => "用户名不能为空"
            ];
            return $data;
        }
        if(empty($password)){
            $data = [
                'errno' => 00002,
                'msg'   => "密码不能为空"
            ];
            return $data;
        }
        $user = new user();
        $username = $user::where(['user_name'=>$user_name])->first();
        if(!$username){
            $data = [
                'errno' => 00006,
                'msg'   => "用户名不存在"
            ];
            return $data;
        }
        if($username['password']==$password){
            $data = [
                'errno' => 00007,
                'msg'   => "登录成功"
            ];
            return $data;
        }
    }
}
