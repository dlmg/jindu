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


/**
 * Class Client
 * @package app\admin\controller
 * @create_time 2020/4/2 9:59:20
 * @Author MG <dlmg521@163.com>
 */
class Client extends Base
{
    public function index()
    {
        $this->assign('title', '用户管理');
        return $this->fetch();
    }


    /**
     * @name `clientList`  客户列表
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @create_time 2020/4/2 10:01:17
     */
    public function clientList()
    {
        // 定义全局查询条件
        $map = []; // 将所有的查询条件封装到这个数组中

        // 搜索功能
        $keywords = Request::param('keywords');
        if (!empty($keywords)) {
            $map[] = ['khName', 'like', '%' . $keywords . '%'];
        }

        // 定义分页参数
        $client = new ClientModel;

        $clientList = $client->paginate(input("get.limit"), input("get.page"),$map);
        /*
        $clientList = ClientModel::where($map)
            ->order('client_id', 'desc')
            ->field('client_id, khName, truename, mobile, create_time, update_time, status')
            ->select();*/
        $total = count(ClientModel::where($map)->select());
        $result = array("code" => 0, "msg" => "查询成功", "count" => $total, "data" => $clientList);
        return json($result);
    }


    //添加客户
    public function add()
    {
        // 设置模板变量
        $this->assign('title', '添加客户');
        // 渲染模板
        return $this->fetch('add');
    }


    /**
     * @name `doAdd`   将新增客户添加到数据库
     * @return array
     * @create_time 2020/4/2 10:01:27
     */
    public function doAdd()
    {
        // 获取用户提交的信息
        $data = Request::param();
        $data['password'] = makePassword($data['password']);
        //dump($data);
        // 执行添加操作
        try {
            $role = ClientModel::where('khName', $data['khName'])->find();
            if (!empty($role)) {
                return resMsg(-1, '用户名已经存在，不能重复添加', 'add');
            }
            ClientModel::create($data);
        } catch (\Exception $e) {
            return resMsg(0, '客户添加失败' . '<br>' . $e->getMessage(), 'add');
        }
        return resMsg(1, '客户添加成功', 'index');
    }


    /**
     * @name `setStatus`  更改用户状态
     * @return array
     * @create_time 2020/4/2 10:01:59
     */
    public function setStatus()
    {
        // 1. 获取用户提交的数据
        $data = Request::param();

        // 2. 取出数据
        $id = $data['id'];
        $status = $data['status'];

        // 3. 更新数据，判断显示状态，如果为1则更改为0，如果为0则更改为1
        try {
            if ($status == 1) {
                ClientModel::where('client_id', $id)
                    ->data('status', 0)
                    ->update();
            } else {
                ClientModel::where('client_id', $id)
                    ->data('status', 1)
                    ->update();
            }
        } catch (\Exception $e) {
            return resMsg(0, '<i class="iconfont">&#xe646;</i> 操作失败，请检查' . '<br>' . $e->getMessage(), 'index');
        }
        return resMsg(1, '<i class="iconfont">&#xe645;</i> 状态变更成功', 'index');
    }


    public function edit()
    {
        $adminId = Request::param('id');
        $clientInfo = ClientModel::where('client_id', $adminId)->field('client_id, khName, mobile, status')->find();
        $this->assign('title', '编辑用户');
        $this->assign('clientInfo', $clientInfo);
        return $this->fetch('edit');
    }


    /**
     * @name `doEdit`  把编辑的信息更新到数据库
     * @return array
     * @create_time 2020/4/2 10:03:16
     */
    public function doEdit()
    {
        // 1. 获取的用户提交的信息
        $data = Request::param();

        if (!empty($data['password'])) {
            $data['password'] = makePassword($data['password']);
        } else {
            unset($data['password']);
        }

        //$data['update_time'] = time();

        // 执行编辑操作
        try {
            $client = ClientModel::where('khName', $data['username'])->where('client_id', '<>', $data['client_id'])->find();
            if (!empty($client)) {
                return resMsg(-1, '用户名已经存在，请重新修改', 'edit');
            }
            $where = array('client_id' => $data['client_id']);
            ClientModel::update($data, $where);
        } catch (\Exception $e) {
            return resMsg(0, '用户编辑失败' . '<br>' . $e->getMessage(), 'edit');
        }
        return resMsg(1, '用户编辑成功', 'index');
    }


    // 删除用户
    public function delete()
    {
        if (Request::isAjax()) {
            // 执行删除操作
            try {
                $id = Request::param('id');
                ClientModel::where('client_id', $id)->delete();
            } catch (\Exception $e) {
                return resMsg(0, '用户删除失败' . '<br>' . $e->getMessage(), 'index');
            }
            return resMsg(1, '用户删除成功', 'index');
        } else {
            return resMsg(-1, '请求类型错误', 'index');
        }
    }
}