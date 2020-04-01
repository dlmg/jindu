<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/13
 * Time: 11:55
 */

namespace app\admin\controller;
use app\admin\common\model\Project as Pro;
use app\admin\common\model\Buzhou;
use app\admin\common\model\Admin;
use app\admin\common\controller\Base;
use app\admin\common\model\Detail;
use think\Db;
use think\facade\Request;
use app\admin\common\model\Fenbu;

class Project extends Base
{
    public function index(){
        $this -> view -> assign('title', '我的项目管理');
        return $this -> view -> fetch('index');
    }

    public function all(){
        $this->assign('title', '所有项目');
        return $this->fetch();
    }

    public function allList(){
        $map = []; // 将所有的查询条件封装到这个数组中

        // 搜索功能
        $keywords = Request::param('keywords');
        if ( !empty($keywords) ) {
            $map[] = ['proName', 'like', '%'.$keywords.'%'];
        }

        $data = Pro::where($map)
            ->select();
        $count = count($data);
        $result = array("code"=>0,"msg"=>'查询成功',"count"=>$count,"data"=>$data);
        //dump($result);
        return json($result);
    }

    public function proList(){
        // 定义分页参数
        $id = session('admin_id');
        $sql = "select a.id,a.proName,a.description,a.create_time,a.status,b.truename from think_project a join think_client b on a.client_id=b.client_id where find_in_set($id,user_id) and 'status'=0";
        $proList = Db::query($sql);
        //dump($data);
        $count = count($proList);
        $result = array("code" => 0, "msg" => "查询成功",  "count"=>$count, "data" => $proList);
        return json($result);
    }


    public function detail(){
        $id = input('id');
        //连表查询得到详情页所需要用到的字段值
        //$sql = "select buzhou,is_right,is_goto from think_schedule where project_id = $id";
        $sql = "select a.buzhou,a.create_time,a.is_goto,a.is_right,b.statusName,a.project_id,a.is_ready from think_schedule a join think_buzhou b on a.buzhou=b.id where a.project_id=$id order by a.buzhou asc ";
        $data = Db::query($sql);
        //$sql = "select a.id,a.operation,a.file_url,a.create_time,a.buzhou,a.upload_desc from think_detail a join think_schedule b on a.pro_id=b.project_id and a.buzhou=b.buzhou where b.project_id=$id order by a.create_time asc";
        $sql = "select id,operation,create_time,buzhou,file_url,description,url from think_fenbu where pro_id=$id order by create_time asc";
        $operation = Db::query($sql);
        if($operation)
        $this->assign('operation', $operation);
        $this->assign('result', $data);
        $this->assign('title', '项目详情');
        //dump($data);
        return $this->fetch();
    }

    public function bz(){
        $this->assign('title','项目进度步骤管理');
        return $this->fetch();
    }

    public function bzList(){
        $data = Buzhou::all();
        $count = count($data);
        $result = array("code"=>0,"msg"=>'查询成功',"count"=>$count,"data"=>$data);
        return json($result);
    }


    public function edit(){
        //获取要编辑步骤的id
        $id = Request::param('id');
        $data = Buzhou::get($id);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function doEdit(){
        $data = Request::param();
        $buzhou = new Buzhou;
        try{
            $buzhou = $buzhou->save(['statusName'=>$data['statusName']],['id'=>$data['id']]);
        } catch (\Exception $e) {
            return resMsg(0, '步骤名称修改失败' . '<br>' . $e->getMessage(), 'edit' );
        }
        return resMsg(1,"步骤名称修改成功",'all');
    }

    public function editPro(){
        $prolist = Admin::where('a.role_id','>',2)
            ->alias('a')
            ->join(['think_profile'=>'b'],'b.admin_id=a.id')
            ->field('a.id,b.truename')
            ->select();

        $id = input('id');
        $project = new Pro;
        $result = Pro::get($id);
        //dump($result);
        $this->assign('result',$result);
        $this->assign('prolist',$prolist);
        $this->assign('title','编辑项目');
        return $this->fetch();
    }

    public function doEditPro(){
        $id = input('id');
        $data = Request::param();
        $str = implode(',',$data['renyuan']);
        $id = $data['id'];
        $pro = Pro::get($id);
        $pro->user_id = $str;
        if($pro->save()){
            return resMsg(1,'分配员工成功','index');
        }
    }

    public function download(){
        $id = input('id');
        $url = Fenbu::where('id',$id)->value('file_url');
        $download = new \think\response\Download('D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\public/upload/'.$url);
        return $download->name('客户需求');

    }

    public function downloadDt(){
        $id = input('id');
        $url = Detail::where('id',$id)->value('file_url');
        $download = new \think\response\Download('D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\public/upload/'.$url);
        return $download->name('文件');

    }

    public function communication(){
        $buzhou = input('buzhou');
        $pro_id = input('pro_id');
//      var_dump($pro_id);
        $this->assign(['buzhou' => $buzhou, 'pro_id' => $pro_id]);
        $this->assign('title', '上传文件');
        return $this->fetch();
    }

    public function doCommunication(){
        $img = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $img->move(env('ROOT_PATH') . 'public/upload');
        $pro_id = input('pro_id');
        $buzhou = input('buzhou');
        $desc = input('description');
        $user_id = session('admin_id');
        $admin = Admin::get($user_id);
        $name = $admin->profile->truename;
        $hz = $info->getExtension();
        $image = array('jpg','png','bmp','gif','jpeg');
        if(in_array($hz,$image))
            $is_image = 1;
        else
            $is_image = 0;
        Db::startTrans();
        try{
            $create_time = date('Y-m-d H:i:s');
            $data = ['pro_id'=>$pro_id,'buzhou'=>$buzhou,'operation'=>'由'.$name.'上传','file_url'=>$info->getSaveName(),'create_time'=>$create_time,'upload_desc'=>$desc,'is_image'=>$is_image];
            Db::name('detail')->insert($data);
            Db::commit();
        }catch(Exception $e){
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

    public function next(){
        $pro_id = input('pro_id');
        $buzhou = input('buzhou');
        $statusName = input('statusName');
        $user_id = session('admin_id');
        $admin = Admin::get($user_id);
        $name = $admin->profile->truename;

        $fenbu = new Fenbu;
        $fenbu->startTrans();
        $fenbu->pro_id = $pro_id;
        $fenbu->buzhou = $buzhou;
        $fenbu->operation = $name.' 进入了'.$statusName;
        Db::startTrans();
        Db::name('schedule')->where(['project_id'=>$pro_id,'buzhou'=>$buzhou])->setField('is_goto',1);
        if($fenbu->save()){
            $fenbu->commit();
            Db::commit();
            return resMsg(1,'进入成功','detail');
        }else{
            $fenbu->rollback();
            Db::rollback();
            return resMsg(-1,'未知失败','detail');
        }
    }

    public function detailed(){
        $buzhou = input('id');
        $pro_id = input('pro_id');
        $sql = "select upload_desc,operation,create_time from think_detail where pro_id=$pro_id and buzhou=$buzhou group by create_time";
        $result = Db::query($sql);
        $sql1 = "select * from think_detail WHERE create_time in ( select create_time from  think_detail group by create_time) and pro_id=$pro_id and buzhou=$buzhou";
        $data = Db::query($sql1);
        $this->assign('title', '查看内容');
        $this->assign('result',$result);
        $this->assign('data',$data);
        $this->assign('buzhou',$buzhou);
        $this->assign('pro_id',$pro_id);
        return $this->fetch();
    }

    public function done(){
        $buzhou = input('buzhou');
        $pro_id = input('pro_id');
        $statusName = Db::name('buzhou')->where('id',$buzhou)->value('statusName');
        if(request()->isGet()){
            $this->assign('buzhou',$buzhou);
            $this->assign('pro_id',$pro_id);
            return $this->fetch();
        }elseif(request()->isPost()){
            $buzhou = input('buzhou');
            $pro_id = input('pro_id');
            $description = input('description');
            $url = input('url');
            $fenbu = new Fenbu;
            $fenbu->pro_id = $pro_id;
            $fenbu->buzhou = $buzhou;
            $fenbu->description = $description;
            $fenbu->url = $url;

            $user_id = session('admin_id');
            $admin = Admin::get($user_id);
            $name = $admin->profile->truename;
            $fenbu->operation = $name.' 完成了'.$statusName;
            $fenbu->startTrans();
            Db::startTrans();
            $result = Db::name('schedule')->where(['project_id'=>$pro_id,'buzhou'=>$buzhou])->setField('is_ready',1);
            if($fenbu->save()&&$result){
                $fenbu->commit();
                Db::commit();
                return resMsg(1,'提交成功','detail');
            }else{
                $fenbu->rollback();
                Db::rollback();
                return resMsg(-1,'提交失败,请重试','detailed');
            }
        }
    }

    public function setStatus(){
        if(request()->isPost()) {
            $id = input('id');
            Db::startTrans();
            $flag = Db::name('project')->where('id', $id)->setField('status', 2);
            if ($flag > 0) {
                Db::commit();
                $msg = array(
                    'status' => 200,
                    'message' => '审核已通过',
                    'url' => 'admin/project/all'
                );
                return json($msg);
            } else {
                Db::rollback();
                $msg = array(
                    'status' => 201,
                    'message' => '审核未通过',
                    'url' => 'admin/project/all'
                );
                return json($msg);
            }
        }else{
            $msg = array(
                'status' => 201,
                'message' => '审核未通过',
                'url' => 'admin/project/all'
            );
            return json($msg);
        }
    }
}