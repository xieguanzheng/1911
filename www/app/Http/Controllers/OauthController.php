<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use DB;
class OauthController extends Controller
{
    public function git(){
        echo 123;
        //echo '<pre>';print_r($_GET);echo '</pre>';
    }

}