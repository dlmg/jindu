<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/13
 * Time: 11:55
 */

namespace app\admin\controller;
use app\admin\common\model\Project as Pro;
use app\admin\common\model\Schedule;
use app\admin\common\model\Buzhou;
use app\admin\common\model\Admin;
use app\admin\common\controller\Base;
use app\admin\common\model\Detail;
use think\App;
use think\Db;
use think\facade\Request;

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
        $sql = "select a.buzhou,a.create_time,a.is_right,b.statusName,a.project_id from think_schedule a join think_buzhou b on a.buzhou=b.id where a.project_id=$id order by a.buzhou asc ";
        $data = Db::query($sql);
        $sql = "select a.id,a.operation,a.file_url,a.create_time,a.buzhou,a.upload_desc from think_detail a join think_schedule b on a.pro_id=b.project_id and a.buzhou=b.buzhou where b.project_id=$id order by a.create_time asc";
        $operation = Db::query($sql);
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
            return resMsg(1,'分配成功','index');
        }
    }

    public function download(){
        $id = input('id');
        $url = Detail::where('id',$id)->value('file_url');
        $download = new \think\response\Download('D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\public/upload/'.$url);
        return $download->name('my.pdf');
        // 或者使用助手函数完成相同的功能
        // // download是系统封装的一个助手函数
//        return download('image.jpg', 'my.jpg');
    }
}