<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/12
 * Time: 16:51
 */

namespace app\admin\model;
use think\Model;

class Profile extends Model
{
    public function user()
    {
        // 档案 BELONGS TO 关联用户
        return $this->belongsTo('User');
    }
}