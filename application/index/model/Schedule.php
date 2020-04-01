<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/17
 * Time: 10:56
 */

namespace app\index\model;
use think\Model;

class Schedule extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $updateTime = false;
}