<?php
namespace app\index\controller;
use app\index\model\Client;
use think\Db;

class Index extends Base
{
    public function index()
    {
        //$this->assign('title','');
        $this->assign('name',session('name'));
        return $this->fetch();
    }






}
