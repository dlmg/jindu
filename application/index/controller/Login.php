<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/14
 * Time: 15:08
 */

namespace app\index\controller;

use think\captcha\Captcha;
use think\Controller;
use app\index\model\Client;
use think\facade\Session;
use think\facade\Request;

class Login extends Controller
{
    public function index()
    {

        return $this->fetch();
    }

    public function verify(){
        $captcha = new Captcha();
        return $captcha->entry();
    }
    public function check(){
        $data = Request::param();

        // 判断验证是否正确
        if ( !captcha_check($data['verify']) ) {
            return resMsg(-2, '验证码错误', 'index');
        }else{
            $user = new Client;
            $result = $user->where('khName',$data['username'])->find();
            if(!$result)
                return resMsg(-1,'用户不存在','index');
            if($result['password']!=makePassword($data['password']))
                return resMsg(-1,'密码错误','index');
                SESSION::set('user_id',$result['client_id']);
                SESSION::set('user_name',$result['khName']);
                SESSION::set('name',$result['truename']);
            return resMsg(1, '登录成功', '/user/info');
        }
    }

    public function logout()
    {
        session('user_id', null);
        session('user_name', null);
        $this -> redirect('index/login/index');
    }
}