<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use rbac\Rbac;
use think\Db;
use ipquery\IPQuery;

/**
 * 通过加盐方式生成加密密码
 * @param $password
 * @return string
 */
function makePassword($password) {
    return sha1(md5($password . config('admin.salt')));
}

/**
 * 检测密码
 * @param $dbPassword
 * @param $inputPassword
 * @return bool
 */
function checkPassword($inputPassword, $dbPassword) {
    return ( makePassword($inputPassword) == $dbPassword );
}

/**
 * 获取当前MySQL版本
 * @return string
 */
function getMysqlVersion() {
    $res = Db::query('select VERSION() as sqlversion');
    $data['MySQL_Version'] = $res[0]['sqlversion'];
    return $res[0]['sqlversion'];
}

/**
 * 生成Layui子孙树，格式化后台左侧菜单列表
 * @param $data
 * @return array
 */
function makeTree($data) {

    $res = [];
    $tree = [];

    // 整理数组
    foreach ($data as $key => $vo) {
        $res[$vo['id']] = $vo;
        $res[$vo['id']]['children'] = [];
    }
    unset($data);

    // 查询子孙
    foreach ($res as $key => $vo) {
        if($vo['pid'] != 0){
            $res[$vo['pid']]['children'][] = &$res[$key];
        }
    }

    // 去除杂质
    foreach ($res as $key => $vo) {
        if($vo['pid'] == 0){
            $tree[] = $vo;
        }
    }
    unset($res);

    return $tree;
}

/**
 * 格式化dump调试函数
 * @param $data
 */
function dump($data) {
    echo "<pre>";
    print_r($data);
}

/**
 * 按钮检测
 * @param $input
 * @return bool
 */
function buttonCheck($input)
{
    $rbac = Rbac::instance();
    return  $rbac->authCheck($input, session('admin_role_id'));
}

/**
 * 返回json格式信息
 * @param $status
 * @param $message
 * @param $url
 * @return array
 */
function resMsg($status, $message, $url)
{
    return ['status' => $status, 'message' => $message, 'url' => $url];
}

/**
 * 模型返回标准函数
 * @param $code
 * @param $data
 * @param $msg
 * @return array
 */
function modelReMsg($code, $data, $msg) {

    return ['code' => $code, 'data' => $data, 'msg' => $msg];
}

/**
 * $msg 待提示的消息
 * $url 待跳转的链接
 * $icon 这里主要有两个，5和6，代表两种表情（哭和笑）
 * $time 弹出维持时间（单位秒）
 */
function alert($msg='',$url='',$icon='',$time=2){
    $str='<script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script><script type="text/javascript" src="/static/layui/lay/layer.js"></script>';//加载jquery和layer
    $str.='<script>$(function(){layer.msg("'.$msg.'",{icon:'.$icon.',time:'.($time*1000).'});setTimeout(function(){self.location.href="'.$url.'"},2000)});</script>';//主要方法
    return $str;
}