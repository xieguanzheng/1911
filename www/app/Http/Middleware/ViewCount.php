<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use App\Model\P_token AS TokenModle;
class ViewCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->get('token');
        if(empty($token))
        {

            $response = [
                'erron' => 400003,
                'msg' => '未授权'
            ];
            return response()->json($response);
        }

        $t = TokenModle::where(["token"=>$token])->first();
        if(empty($t)){
            $response = [
                "errno" => "40003",
                "msg" => "token无效"
            ];
            return response()->json($response);
        }
        $user_info = User::find($t->uid);
        $response = [
            "errno" => 0,
            "msg" => "ok",
            "data"=>[
                "user_info"=> $user_info
            ]
        ];
        return response()->json($response);
    }
}
