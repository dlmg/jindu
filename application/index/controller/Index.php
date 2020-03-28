<?php
namespace app\index\controller;
use app\index\model\Project;
use app\index\model\Client;
use think\facade\Request;
use think\Validate;
use think\Db;

class Index extends Base
{
    public function index()
    {
        $user_id = session('user_id');
        $this->assign('name', session('name'));
        $pro = new Project;
        $client = new Client;
        $count = count($pro->where('client_id', $user_id)->select());
        $data = $client->where('client_id', $user_id)->find();
        $this->assign('count', $count);
        $this->assign('data', $data);
        $this->assign('action', 'index');
        return $this->fetch();
    }

    public function editPassword()
    {
        if (request()->isGet()) {
            $this->assign('action', 'index');
            return $this->fetch();
        } elseif (request()->isPost()) {
            $rule = [
                'old_password' => 'require|length:6,60',
                'new_password' => 'require|length:6,60',
                'con_password' => 'require|length:6,60',
            ];

            $msg = [
                'old_password.require' => '原密码为必填项',
                'old_password.length' => '密码长度要在6~60之间',
                'new_password.require' => '新密码为必填项',
                'new_password.length' => '密码长度要在6~60之间',
                'con_password.require' => '确认密码为必填项',
                'con_password.length' => '密码长度要在6~60之间',
            ];

            $old_password = input('old_password');
            $new_password = input('new_password');
            $con_password = input('con_password');

            $data = [
                'old_password' => $old_password,
                'new_password' => $new_password,
                'con_password' => $con_password,
            ];

            $validate = Validate::make($rule, $msg);
            $result = $validate->check($data);

            if(!$result){
                $info = $validate->getError();
                return resMsg(-1,"$info",'/user/info');
            }

            $user_id = session('user_id');
            $user = Db::name('client')->where('client_id',$user_id)->find();
            if($user['password'] != makePassword($old_password)){
                return resMsg(-1,'原始密码不正确','user/editpwd');
            }
            $pwd = makePassword($new_password);
            $flag = Db::name('client')->where('client_id',$user_id)->update(['password'=>$pwd]);
            if($flag){
                $msg = array(
                    "status" => 200,
                    "info" => "修改成功！",
                    "url" => url('index/member/property'),
                );
                return json($msg);
            }else{
                $msg = array(
                    "status" => 201,
                    "info" => "修改失败！",
                );
                return json($msg);
            }
        }

    }
}
