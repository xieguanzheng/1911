<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use DB;
class TestController extends Controller{
    public function getWToken(){
        $appid ="wxcd43d01b649b84cb";
        $appsec='793511b9c6ff0f3364b3fc7c9e324c75';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsec;
        $cont=file_get_contents($url);
        echo $cont;
    }
    public function getWToken2()
    {
        $appid ="wxcd43d01b649b84cb";
        $appsec='793511b9c6ff0f3364b3fc7c9e324c75';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsec;

        // 创建一个新cURL资源
        $ch = curl_init();

        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);      // 将返回结果通过变量接收

        // 抓取URL并把它传递给浏览器
        $response = curl_exec($ch);

        // 关闭cURL资源，并且释放系统资源
        curl_close($ch);

        echo $response;
    }
    public function getWToken3(){
        $appid ="wxcd43d01b649b84cb";
        $appsec='793511b9c6ff0f3364b3fc7c9e324c75';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsec;

        $client=new client();
        $response=$client->request('GET',$url);
        // dd($response);
        $data=$response->getBody();
        echo $data;

    }
    public function test1(){
        $url ='http://mp.1911.com/user/info';
        $response=file_get_contents($url);
        var_dump($response);
    }
    public function login(Request $request){
        echo '<pre>';print_r($_POST);echo'</pre>';
        $email=$request->post('email');
        $pass=$request->post('pass');
    }
//    public function b(){
//        $goods_info=[
//            'goods_id'=>12345,
//            'goods_name'=>'IPhonex',
//            'price'=>800000,
//            'add_time'=>123123123
//        ];
//        $key ='goods_12345';
//        Redsi::hmset($key,$goods_info);
//    }
 public function hash1(){
     $data=[
         'name'=>'xie',
         'email'=> 'xie@qq.com',
         'age'=> 17,
     ];
     $key ='user_info1';
     Redis::hMset($key,$data);
 }
    public function hash2(){
        $key ='user_info1';
        $data=Redis::hgetall($key);
        echo '<pre>';print_r($data);echo'</pre>';
    }
    public  function cont()
    {
        $store = Redis::llen('store');
        $storeinfo = Redis::lrange('store', 0, -1);
        if (!$storeinfo) {
            Redis::lpush('store', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1,1,1,1,1);
        }
        if ($store > 0) {
            Redis::lpop('store');
            $content = '库存-1';
            $content . "剩余" . $store;die;
        } else {
            $content = "库存没有咯!";
            echo $content . "库存剩余".$store;die;
        }
    }
}