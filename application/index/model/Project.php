<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/17
 * Time: 10:02
 */

namespace app\index\model;
use think\Model;
use think\Request;

class Project extends Model
{
    //自动写入时间段
    protected $autoWriteTimestamp = 'datetime';
    protected $auto = ['client_id'=>"session('user_id')"];
    //自动完成client_id的写入
    protected function setClientIdAttr(){
        return request()->session('user_id');
    }

    public function schedule(){
        return $this->hasMany('Schedule');
    }

    public function detail(){
        return $this->hasMany('Detail');
    }

    public function fenbu(){
        return $this->hasOne('Fenbu');
    }
}