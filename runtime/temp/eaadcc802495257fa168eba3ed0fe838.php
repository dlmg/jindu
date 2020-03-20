<?php /*a:4:{s:76:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\user\profile.html";i:1584439658;s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\public\header.html";i:1584417627;s:74:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\public\nav.html";i:1584440017;s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\public\footer.html";i:1584440074;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'赛思特')); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/static/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/static/assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="/static/assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/static/assets/css/main.css">
    <link rel="stylesheet" href="/static/assets/css/zheDie.css">
    <link rel="stylesheet" type="text/css" href="/static/css/public/public.css" />
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/admin/layuimini.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/iconfont/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/admin/admin.css" />
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="/static/assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="icon" type="image/png" sizes="96x96" href="/static/assets/img/favicon.ico">
    <script src="/static/js/vue.js"></script>
</head>


<body>
<!-- WRAPPER -->
<div id="wrapper">
    <!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="brand">
            <a href="index.html"><img src="/static/assets/img/logo.png" alt="赛思特 Logo" class="img-responsive logo"></a>
        </div>
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
            </div>
            <div id="navbar-menu">
                <ul class="nav navbar-nav navbar-right"><!--
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="lnr lnr-alarm"></i>
                            <span class="badge bg-danger">5</span>
                        </a>
                        <ul class="dropdown-menu notifications">
                            <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
                            <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
                            <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
                            <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
                            <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
                            <li><a href="#" class="more">See all notifications</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Basic Use</a></li>
                            <li><a href="#">Working With Data</a></li>
                            <li><a href="#">Security</a></li>
                            <li><a href="#">Troubleshooting</a></li>
                        </ul>
                    </li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><?php echo htmlentities(app('request')->session('name')); ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url('user/profile'); ?>"><i class="lnr lnr-user"></i><span>个人资料</span></a></li>
                            <li><a href="<?php echo url('login/logout'); ?>"><i class="lnr lnr-exit"></i> <span>退出登录</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav" id="nav">
                    <li><a href="<?php echo url('index/index'); ?>" class="active"><i class="lnr lnr-home"></i> <span>首页</span></a></li>
                    <li><a href="<?php echo url('project/index'); ?>" class=""><i class="lnr lnr-book"></i> <span>我的项目</span></a></li>
                    <li><a href="<?php echo url('project/add'); ?>" class=""><i class="lnr lnr-code"></i> <span>提交项目</span></a></li>
                    <li>
                        <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>个人中心</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages" class="collapse ">
                            <ul class="nav">
                                <li><a href="javascript:;" onclick="editPassword();">修改密码</a></li>
                                <li><a href="<?php echo url('user/logout'); ?>" class="">退出登录</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- END LEFT SIDEBAR -->

        <script type="text/javascript" >
            //获取div下面所有的a标签（返回节点对象）
            var myNav = document.getElementById("nav").getElementsByTagName("a");
            //获取当前窗口的url
            var myURL = document.location.href;
            //循环div下面所有的链接，
            for(var i=1;i<myNav.length;i++){
                //获取每一个a标签的herf属性
                var links = myNav[i].getAttribute("href");
                var myURL = document.location.href;
                //查看div下的链接是否包含当前窗口，如果存在，则给其添加样式
                if(myURL.indexOf(links) != -1){
                    myNav[i].className="active";
                    myNav[0].className="";
                }
            }
    </script>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img src="/static/images/wechat-logo.png" width="60" class="img-circle" alt="Avatar">
                                <h3 class="name"><?php echo htmlentities(app('request')->session('user_name')); ?></h3>
                            </div>
                            <div class="profile-stat">
                                <div class="row">
                                    <div class="col-md stat-item">
                                        <a href="<?php echo url('project/index'); ?>"><span><?php echo htmlentities($count); ?> 个项目</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">基础资料</h4>
                                <ul class="list-unstyled list-justify">
                                    <li>手机 <span><?php echo htmlentities($data['mobile']); ?></span></li>
                                    <li>姓名 <span><?php echo htmlentities($data['truename']); ?></span></li>
                                </ul>
                            </div>
                            <div class="text-center"><a href="<?php echo url('user/edit',array('id'=>session('user_id'))); ?>" class="btn btn-primary">编辑资料</a></div>
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
<script src="/static/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/static/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/static/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="/static/assets/vendor/chartist/js/chartist.min.js"></script>
<script src="/static/assets/scripts/klorofil-common.js"></script>

<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/admin/layout.js"></script>
<script>
    layui.use([ 'layer'], function () {
        var $ = layui.jquery,
            layer = layui.layer;
        layuimini.init('');
    });
    // 修改密码
function editPassword() {
var index = layer.open({
type: 2,
title: '<i class=iconfont>&#xe7c7;</i> 修改密码',
area: ['550px', '650px'],
content: ['<?php echo url("user/edit"); ?>', 'no'],
skin: 'layui-layer-molv',
btn: ['保存', '取消'],
btnAlign: 'c',
yes: function(index, layero){
var submit = layero.find('iframe').contents().find("#submit");// #subBtn为页面层提交按钮ID
submit.click();// 触发提交监听
return false;
},
btn2:function (index,layero) {
layer.close(index);
}
});
}
</script>