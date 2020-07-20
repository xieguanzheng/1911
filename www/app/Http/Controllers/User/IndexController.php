<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\TokenModle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

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
        $u = $user::where(['user_name'=>$user_name])->first();
        if(!$u){
            $data = [
                'errno' => 00006,
                'msg'   => "用户名不存在"
            ];
            return $data;
        }
        if($u['password']==$password){


            //生产token
            $token = Str::random(32);
            $expire_seconds = 7200;

            $arr = [
                'token' =>$token,
                'uid'   =>$u->user_id,
                'expire_at' => time() + $expire_seconds
            ];

            TokenModle::insertGetid($arr);
            $request_uri=$_SERVER['REQUEST_URI'];
            //echo 'request_uri:'.$_SERVER['REQUEST_URI'];echo '</br>';
            $url_hash=substr(md5($request_uri),5,10);
            $expire =10;//时间
            //echo 'url_hash:'.$url_hash;
            $key='access_token'.$url_hash;
            //echo 'redis key:'.$key;
            $total =Redis::incr($key);
            if($total >10){
                echo "请求过于频繁 ,请{$expire}秒后再尝试";
                //设置过期时间
                Redis::expire($key,10);
            }else{
                echo '当前访问次数为:'.$total;
            }
            $data = [
                'errno' => 0,
                'msg'   => "登录成功",
                'data' => [
                    'token' =>$token,
                    'expire_in' => $expire_seconds
                ]
            ];
        }else{
            $data = [
                'errno' => 500002,
                'msg'   => "密码错误"
            ];
        }
        return $data;
    }
   public function center(Request $request)
   {
       $token=$request ->get('token');
       $key='s:token:blacklist';
       Redis::sismember($key,$token);
       if(empty($token)){
           $data = [
               'errno' => 500003,
               'msg'   => "没有授权"
           ];
           return $data;
       }
       $t= TokenModle::where(['token'=>$token])->first();
       if($t){
           $user_info=User::find($t->uid);
           $data = [
               'errno' => 0,
               'msg'   => "ok",
               'data'=>[
                   'user_info'=>$user_info
               ]
           ];
           return $data;
       }else {
           $data = [
               'errno' => 500004,
               'msg' => "token"
           ];
           return $data;
       }
   }
}