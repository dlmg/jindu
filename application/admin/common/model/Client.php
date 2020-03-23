<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/12
 * Time: 18:22
 */

namespace app\admin\common\model;
use think\Model;

class Client extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d H:i:s';
}