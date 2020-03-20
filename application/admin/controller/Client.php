<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/20
 * Time: 9:56
 */

namespace app\admin\controller;
use app\admin\common\model\Client AS ClientModel;
use app\admin\common\controller\Base;
class Client extends Base
{
    public function index(){
        $this->assign('title','用户管理');
        return $this->fetch();
    }
}