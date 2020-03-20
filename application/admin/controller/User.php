<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/12
 * Time: 16:40
 */

namespace app\admin\controller;

use app\admin\model\Profile;
use app\admin\common\controller\Base;
use app\admin\common\model\Client;
use think\Db;
class User extends Base
{

    public function add()
    {
        $user = new UserModel;
        $username = input('username');
        if ($user->where('username', '=', $username)->find()) {
            return $this->error('用户名已存在', '/admin/index/index');
        }

        if ($user->allowField(true)->save(input('post.'))) {
            $profile = new Profile;
            $profile->truename = input('truename');
            $user->profile()->save($profile);
            if (input('group_id') != 5)
                echo "<script>alert('员工信息添加成功');window.location.href='/admin/index/index';</script>";
            else
                echo "<script>alert('客户信息添加成功');window.location.href='/admin/index/index';</script>";
        } else {
            return $user->getError();
        }
    }

    /*Public function addClient()
    {
        $client = new client;
        $clientName = input('khname');
        if ($client->where('khName', '=', "$clientName")->find()) {
            return $this->error('用户名已存在', '/user/add_client');
        }

        if ($client->allowField(true)->save(input('post.'))) {
            echo "<script>alert('客户信息添加成功');window.location.href='/admin/index/index';</script>";
        } else {
            return $client->getError();
        }
    }*/

    public function check($username)
    {
        $user = new UserModel;
        $info = $user->where('username', '=', "$username")->find();
        if ($info)
            return '*该账户已存在';
        else {
            return '账号验证通过';
        }
    }

    /*Public function checkName($khName)
    {
        $user = new client;
        $info = $user->where('khname', '=', "$khName")->find();
        if ($info)
            return '*该账户已存在';
        else {
            return '账号验证通过';
        }
    }*/

    public function userList(){
        $data = Db::name('user')->alias('a')->join('limit b','a.group_id=b.limit_id')->join('profile c','a.id=c.user_id')->where('a.group_id','<>',5)->paginate(8);
        $page = $data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        //dump($data);
        return $this->fetch();
    }

    /*public function userSearch(Request $request){
        $param = $request->param();
        unset($param['page']);
        $whereMap = new Where;
        foreach($param as $k=>$v)
            $whereMap[$k] = ['like','%'.$v.'%'];
        $data = Db::name('user')->alias('a')->join('limit b','a.group_id=b.limit_id')->join('profile c','a.id=c.user_id')->where('a.group_id','<>',5)->paginate(2,false,['query'=>$request->param()]);
        $page = $data->render();
        $this->assign(['data'=>$data,'page'=>$page]);
        return $this->fetch('article_list');
    }*/

}