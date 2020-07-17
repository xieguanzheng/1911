<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
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
}