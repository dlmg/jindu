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
use app\admin\common\controller\Base;
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
        $sql = "select a.buzhou,b.statusName from think_schedule a join think_buzhou b on a.buzhou=b.id join think_project c on c.id=a.project_id where a.project_id=$id order by a.buzhou asc ";
        $data = Db::query($sql);
        $this->assign('result',$data);
        $this->assign('title','项目详情');
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
}