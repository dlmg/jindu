<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/14
 * Time: 18:50
 */

namespace app\index\controller;
use app\index\model\Project;
use app\index\model\Client;
use think\facade\Request;

class User extends Base
{
    public function profile()
    {
        $client_id = session('user_id');
        $pro = new Project;
        $client = new Client;
        $count = count($pro->where('client_id',$client_id)->select());
        $data = $client->where('client_id',$client_id)->find();
        $this->assign('count',$count);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function edit(){
        $id = session('user_id');
        $username = session('user_name');
       $this->assign(['username'=>$username,'id'=>$id]);
        return $this->fetch();
    }

    public function doEditPwd()
    {
        // 获取的用户提交的信息
        $data = Request::param();

        // 判断原密码是否正确
        $password = Client::where('client_id', $data['id']) -> find()['password'];

        if ( !checkPassword($data['original_password'], $password) ) {
            return resMsg(-1, '原密码错误，请重新输入', 'editPassword');
        }

        $datas = [
            'password' => makePassword($data['password']),
            'update_time' => time()
        ];

        // 执行密码修改操作
        try {
            $admin = Client::where('client_id', $data['id']) -> update($datas);
        } catch (\Exception $e) {
            return resMsg(0, '密码修改失败' . '<br>' . $e->getMessage(), 'edit' );
        }
        return resMsg(1, '密码修改成功', 'index');
    }
}