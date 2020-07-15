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
    public function getWToken3(){
        $appid ="wxcd43d01b649b84cb";
        $appsec='793511b9c6ff0f3364b3fc7c9e324c75';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsec;

        $client=new client();
        $response=$client->request('GET',$url);
        //dd($response);
        $data=$response->getBody();
        echo $data;

    }


}