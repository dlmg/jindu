<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/16
 * Time: 17:32
 */

namespace app\index\controller;

use think\Db;
use app\index\model\Client;
use app\index\model\Project as Pro;
use app\index\model\Schedule;
use app\index\model\Detail;
use think\Exception;

class Project extends Base
{
    public function index()
    {
        $this->assign('title', '我的项目');
        $user_id = session('user_id');
        $sql = "select * from think_project where client_id=$user_id";
        $data = Db::query("$sql");
        $count = count($data);
        $this->assign('count', $count);
        $this->assign('data', $data);
        return $this->fetch();
    }

    public function detail()
    {
        $id = input('id');
        //连表查询得到详情页所需要用到的字段值
        $sql = "select a.buzhou,a.create_time,a.is_right,b.statusName,a.project_id,a.is_ready,a.is_goto from think_schedule a join think_buzhou b on a.buzhou=b.id where a.project_id=$id order by a.buzhou asc ";
        $data = Db::query($sql);
        //$sql = "select a.operation,a.file_url,a.create_time,a.buzhou from think_detail a join think_schedule b on a.pro_id=b.project_id and a.buzhou=b.buzhou where b.project_id=$id";
        $sql = "select id,operation,create_time,buzhou,url from think_fenbu where pro_id=$id order by create_time asc";
        $operation = Db::query($sql);
        $this->assign('operation', $operation);
        $this->assign('result', $data);
        $this->assign('title', '项目详情');
        //dump($data);
        return $this->fetch();
    }

    public function add()
    {
        $id = session('user_id');
        $client = new Client;
        $data = $client->where('client_id', $id)->find();
        $this->assign('contact', $data->mobile);
        //dump($data);
        /*$this->assign('contact',$data);*/
        return $this->fetch();
    }

    public function save()
    {

        if ($this->request->isPost()) {
            $data = $this->request->param();
            $pro = new Pro;
            $pro->startTrans();
            if ($pro->save($data)) {
                if ($pro->schedule()->save(['project_id' => $pro->id, 'buzhou' => 2, 'is_right' => 0]))
                    $pro->schedule()->save(['project_id' => $pro->id, 'buzhou' => 1, 'is_right' => 1]);
                $pro->detail()->save(['pro_id' => $pro->id, 'buzhou' => 1, 'operation' => '用户已经提交了项目']);
                $pro->detail()->save(['pro_id' => $pro->id, 'buzhou' => 2, 'operation' => '等待用户上传需求']);
                $pro->commit();
                return resMsg(1, '项目提交成功', 'index');
            } else {
                $pro->rollback();
                return resMsg(0, '项目提交失败', 'index');
            }
        }
    }

    public function upload()
    {
        $buzhou = input('buzhou');
        $pro_id = input('pro_id');
//      var_dump($pro_id);
        $this->assign(['buzhou' => $buzhou, 'pro_id' => $pro_id]);
        $this->assign('title', '上传需求');
        return $this->fetch();
    }

    public function doUpload()
    {
        $img = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $img->move(env('ROOT_PATH') . 'public/upload', '');
        $pro_id = input('pro_id');
        $buzhou = input('buzhou');
        $desc = input('description');
        Db::startTrans();
        try {
            Db::name('schedule')->where('project_id', $pro_id)->where('buzhou', $buzhou)->setField('is_right', 1);
            $create_time = date('Y-m-d H:i:s');
            $data = ['pro_id' => $pro_id, 'buzhou' => $buzhou, 'operation' => '用户已经上传需求', 'file_url' => $info->getSaveName(), 'create_time' => $create_time, 'description' => $desc];
            Db::name('fenbu')->insert($data);
            unset($data);
            $data = ['project_id' => $pro_id, 'buzhou' => 3, 'create_time' => $create_time, 'is_right' => 0];
            Db::name('schedule')->insert($data);
            Db::commit();
        } catch (Exception $e) {
            Db::rollback();
            return $e->getMessage();
        }
        if ($info) {
            // 成功上传后 获取上传信息
            return json(['code' => 0, 'msg' => '上传成功!', 'url' => '/uploads/' . $info->getSaveName()]);
        } else {
            // 上传失败获取错误信息
            return json(['code' => 1, 'msg' => $img->getError(), 'url' => '']);
        }
    }

    public function next()
    {
        $pro_id = input('pro_id');
        $buzhou = input('buzhou');
        $create_time = date('Y-m-d H:i:s');
        Db::startTrans();
        try {
            $data = ['pro_id' => $pro_id, 'buzhou' => $buzhou, 'operation' => '客户已经确认', 'create_time' => $create_time];
            Db::name('fenbu')->insert($data);
            Db::name('schedule')->where('project_id', $pro_id)->where('buzhou', $buzhou)->setField('is_right', 1);
            unset($data);
            $data = ['project_id' => $pro_id, 'buzhou' => $buzhou + 1, 'create_time' => $create_time, 'is_right' => 0];
            Db::name('schedule')->insert($data);
            Db::commit();
            return resMsg(1, '执行成功', 'index');
        } catch (Exception $e) {
            Db::rollback();
            return resMsg(2, '执行失败', 'index');
        }
    }

    public function detailed()
    {
        $buzhou = input('id');
        $pro_id = input('pro_id');
        $sql = "select upload_desc,operation,create_time from think_detail where pro_id=$pro_id and buzhou=$buzhou group by create_time";
        $result = Db::query($sql);
        $sql1 = "select * from think_detail WHERE create_time in ( select create_time from  think_detail group by create_time) and pro_id=$pro_id and buzhou=$buzhou";
        $data = Db::query($sql1);
        $this->assign('title', '查看内容');
        $this->assign('result', $result);
        $this->assign('data', $data);
        $this->assign('buzhou', $buzhou);
        $this->assign('pro_id', $pro_id);
        return $this->fetch();
    }

    public function communication()
    {
        $buzhou = input('buzhou');
        $pro_id = input('pro_id');
//      var_dump($pro_id);
        $this->assign(['buzhou' => $buzhou, 'pro_id' => $pro_id]);
        $this->assign('title', '上传文件');
        return $this->fetch();
    }

    public function doCommunication()
    {
        $img = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $img->move(env('ROOT_PATH') . 'public/upload');
        $pro_id = input('pro_id');
        $buzhou = input('buzhou');
        $desc = input('description');
        $name = session('name');
        $hz = $info->getExtension();
        $image = array('jpg', 'png', 'bmp', 'gif', 'jpeg');
        if (in_array($hz, $image))
            $is_image = 1;
        else
            $is_image = 0;
        Db::startTrans();
        try {
            $create_time = date('Y-m-d H:i:s');
            $data = ['pro_id' => $pro_id, 'buzhou' => $buzhou, 'operation' => '由' . $name . '上传', 'file_url' => $info->getSaveName(), 'create_time' => $create_time, 'upload_desc' => $desc, 'is_image' => $is_image];
            Db::name('detail')->insert($data);
            Db::commit();
        } catch (Exception $e) {
            Db::rollback();
            return $e->getMessage();
        }
        if ($info) {
            // 成功上传后 获取上传信息
            return json(['code' => 0, 'msg' => '上传成功!', 'url' => '/uploads/' . $info->getSaveName()]);
        } else {
            // 上传失败获取错误信息
            return json(['code' => 1, 'msg' => $img->getError(), 'url' => '']);
        }
    }


}