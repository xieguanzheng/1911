<?php

namespace App\Http\Controllers\Admin;
use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function regdo(Request $request)
    {
        $user_name = $request->post('user_name');
        $password = $request->post('password');
        if (empty($user_name)) {
            $data = [
                'errno' => '50001',
                'msg' => "用户名不能为空"
            ];
            return $data;
        }
        if (empty($password)) {
            $data = [
                'errno' => '50002',
                'msg' => "密码不能为空"
            ];
            return $data;
        }

        $User = new user();
        $User->user_name = $user_name;
        $User->password = password_hash($password, PASSWORD_BCRYPT);
        $add = $User->save();
        if ($add) {
            $data = [
                'errno' => '0',
                'msg' => "添加成功"
            ];
            return $data;

        }

    }
}
