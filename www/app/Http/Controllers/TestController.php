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
    /**

* 对称加密
     */
        public function encrtypt1(){
            //echo '123';die;
            $data ='天王盖地虎,宝塔镇河妖';
            $method='AES-256-CBC';
            $key='1911mp';
            $iv='hellohelloABCDEF';
            echo "原密:".$data."<br>"."</hr>";
            //加密数据
            $enc_data=openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
            echo "加密后的:".$enc_data."<br>"."</hr>";
            //post数据

            $post_data = [
                'data' => $enc_data,
            ];
            //将加密的文件发送
            $url='http://mp.1911.com/test/decrypt1';
            //curl初始
            $ch=curl_init();
            //设置参数
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            //发送请求
            $response=curl_exec($ch);
            echo $response;
            //提示错误
            $errno=curl_errno($ch);
            if($errno){
                $errmsg=curl_error($ch);
                var_dump($errmsg);
            }
            curl_close($ch);
        }
    /*
     * 非对称加密
     */
    public function rsa(){
        //echo '123';
        $data="米西米西滑不拉西,如果你不拉西我就不能米西@马帅生";//加密数据
        echo "原密:".$data."<br>"."</hr>";
        //使用公钥加密
        $content=file_get_contents(storage_path('keys/mp_pub.key'));
        $pub_key=openssl_get_publickey($content);
        openssl_public_encrypt($data,$enc_data,$pub_key);
       //var_dump($enc_data);
        echo "加密后的:".$enc_data;
        echo "<br>";
        echo "<hr>";
        //post数据

        $post_data = [
            'data' => $enc_data,
        ];
        //将加密的文件发送
        //curl初始
        $ch=curl_init();
        //设置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //发送请求
        $response=curl_exec($ch);
        echo $response;
        //提示错误
        $errno=curl_errno($ch);
        if($errno){
            $errmsg=curl_error($ch);
            var_dump($errmsg);
        }
        curl_close($ch);
        $pub_key=file_get_contents(storage_path('keys/mp_pub.key'));
        openssl_public_decrypt($response,$enc_data,$pub_key);
        echo "<br>";
        echo "<hr>";
        echo $enc_data;
    }
    /*
     * 签名测试
     */
    public function  sign1(){
        $data="摩西摩西";
        $key='1911';
        $sign_str=md5($data . $key);
        $url='http://mp.1911.com/test/sign1?data='.$data.'&sign='.$sign_str;
        $response=file_get_contents($url);
        echo $response;
    }
}