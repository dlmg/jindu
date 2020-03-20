<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/14
 * Time: 10:24
 */

namespace app\admin\common\model;
use think\Model;

class Project extends Model
{
    protected $autoWriteTimestamp=false;

    public function schedule(){
        return $this->hasOne('Schedule');
    }
}