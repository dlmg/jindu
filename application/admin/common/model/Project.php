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

    public function paginate($limit = 10, $page = 1, $arr = [])
    {
        return self::where($arr)->limit(($page -1) *$limit, $limit)->select();
    }

    public function all($arr = []){
        return self::where($arr)->count();
    }
}