<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/20
 * Time: 9:56
 */

namespace app\admin\controller;
use app\admin\common\controller\Base;
use think\facade\Request;
use app\admin\common\model\Client as ClientModel;

class Client extends Base
{
    public function index(){
        $this->assign('title','用户管理');
        return $this->fetch();
    }

    //客户列表
    public function clientList()
    {
        // 定义全局查询条件
        $map = []; // 将所有的查询条件封装到这个数组中

        // 搜索功能
        $keywords = Request::param('keywords');
        if ( !empty($keywords) ) {
            $map[] = ['khName', 'like', '%'.$keywords.'%'];
        }

        // 定义分页参数
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        // 获取到所有的用户
        $clientList = ClientModel::where($map)
            -> order('client_id', 'desc')
            -> field('client_id, khName, truename, mobile, create_time, update_time, status')
            -> select();

        $total = count(ClientModel::where($map)->select());
        $result = array("code" => 0, "msg" => "查询成功", "count" => $total, "data" => $clientList);
        return json($result);

        // 3. 设置模板变量
        //$this -> view -> assign('adminList', $adminList);

        // 4. 渲染模板
        //return $this -> view -> fetch('index');
    }

    //添加客户
    public function add()
    {
        // 设置模板变量
        $this -> view -> assign('title', '添加管理员');
        // 渲染模板
        return $this -> view -> fetch('add');
    }

    // 执行客户用户添加操作
    public function doAdd()
    {
        // 获取用户提交的信息
        $data = Request::param();
        $data['password'] = makePassword($data['password']);
        //dump($data);
        // 执行添加操作
        try {
            $role = ClientModel::where('khName', $data['khName']) -> find();
            if ( !empty($role)) {
                return resMsg(-1, '用户名已经存在，不能重复添加', 'add');
            }
            ClientModel::create($data);
        } catch (\Exception $e) {
            return resMsg(0, '用户添加失败' . '<br>' . $e->getMessage(), 'add' );
        }
        return resMsg(1, '客户添加成功', 'index');
    }

    //变更用户状态
    public function setStatus()
    {
        // 1. 获取用户提交的数据
        $data = Request::param();

        // 2. 取出数据
        $id = $data['id'];
        $status = $data['status'];

        // 3. 更新数据，判断显示状态，如果为1则更改为0，如果为0则更改为1
        try {
            if ( $status == 1 ) {
                ClientModel::where('client_id', $id)
                    ->data('status', 0)
                    ->update();
            } else {
                ClientModel::where('client_id', $id)
                    -> data('status', 1)
                    -> update();
            }
        } catch (\Exception $e) {
            return resMsg(0, '<i class="iconfont">&#xe646;</i> 操作失败，请检查' . '<br>' . $e->getMessage(), 'index' );
        }
        return resMsg(1, '<i class="iconfont">&#xe645;</i> 状态变更成功', 'index');
    }

    public function edit()
    {
        // 获取节点id
        $adminId = Request::param('id');

        // 根据节点id查询要更新的节点信息
        $clientInfo = ClientModel::where('client_id', $adminId) -> field('client_id, khName, mobile, status') -> find();

        // 获取所有非超级管理员角色

        // 设置模板变量
        $this -> view -> assign('title', '编辑用户');
        $this -> view -> assign('clientInfo', $clientInfo);

        // 渲染模板
        return $this -> view -> fetch('edit');
    }

    // 执行编辑管理员操作
    public function doEdit()
    {
        // 1. 获取的用户提交的信息
        $data = Request::param();

        if ( !empty($data['password']) ) {
            $data['password'] = makePassword($data['password']);
        } else {
            unset($data['password']);
        }

        //$data['update_time'] = time();

        // 执行编辑操作
        try {
            $client = ClientModel::where('khName', $data['username']) -> where('client_id', '<>', $data['client_id']) -> find();
            if ( !empty($client)) {
                return resMsg(-1, '用户名已经存在，请重新修改', 'edit');
            }
            $where = array('client_id'=>$data['client_id']);
            ClientModel::update($data,$where);
        } catch (\Exception $e) {
            return resMsg(0, '用户编辑失败' . '<br>' . $e->getMessage(), 'edit' );
        }
        return resMsg(1, '用户编辑成功', 'index');
    }

    // 删除用户
    public function delete()
    {
        if ( Request::isAjax() ) {
            // 执行删除操作
            try {
                $id = Request::param('id');
                ClientModel::where('client_id', $id) -> delete();
            } catch (\Exception $e) {
                return resMsg(0, '用户删除失败' . '<br>' . $e->getMessage(), 'index' );
            }
            return resMsg(1, '用户删除成功', 'index');
        } else {
            return resMsg(-1, '请求类型错误', 'index');
        }
    }
}