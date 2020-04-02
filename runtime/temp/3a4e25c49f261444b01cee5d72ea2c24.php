<?php /*a:2:{s:83:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\index\edit_password.html";i:1585637787;s:75:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\public\base.html";i:1585805893;}*/ ?>
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
    <!-- ICONS -->
    <link rel="icon" type="image/png" sizes="96x96" href="/static/assets/img/favicon.ico">
    <script src="/static/js/vue.js"></script>
    <script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
    <script src="/static/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/static/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="/static/assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="/static/assets/scripts/klorofil-common.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <script type="text/javascript" src="/static/js/admin/layout.js"></script>
    <style>
        body{
            font-size: 15px;
        }
    </style>
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
                            <li><a href="<?php echo url('index/index/index'); ?>"><i class="lnr lnr-user"></i><span>个人资料</span></a></li>
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
                <ul class="nav" id="nav" style="margin-top:20px;">
                    <li><a href="<?php echo url('index/index/index'); ?>" <?php if($action == 'index'): ?>class="active"<?php endif; ?>><i class="lnr lnr-home"></i> <span>基本信息</span></a></li>
                    <li><a href="<?php echo url('index/project/index'); ?>" <?php if($action == 'project'): ?>class="active"<?php endif; ?>><i class="lnr lnr-book"></i> <span>我的项目</span></a></li>
                    <li><a href="<?php echo url('index/project/add'); ?>" <?php if($action == 'add'): ?>class="active"<?php endif; ?>><i class="lnr lnr-code"></i> <span>提交项目</span></a></li>
                    <li><a href="<?php echo url('index/index/about'); ?>" <?php if($action == 'about'): ?>class="active"<?php endif; ?>><i class="lnr lnr-diamond"></i> <span>关于SIST</span></a></li>
                    <li><a href="<?php echo url('index/login/logout'); ?>"><i class="lnr lnr-exit"></i> <span>退出登录</span></a></li>


                    <!--<li>
                        <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>个人中心</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages" class="collapse ">
                            <ul class="nav">
                                <li><a href="javascript:;" onclick="editPassword();">修改密码</a></li>
                                <li><a href="<?php echo url('login/logout'); ?>" class="">退出登录</a></li>
                            </ul>
                        </div>
                    </li>-->
                </ul>
            </nav>
        </div>
    </div>
    <!-- END LEFT SIDEBAR -->
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT 模板继承-->
        
    <div class="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-6"><span class="panel-note"> 修改登录密码</span></div>

                        </div>
                    </div>
                    <!-- RECENT PURCHASES -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">请认证填写下方信息！</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <form class="form-horizontal" action="<?php echo url('index/index/editPassword'); ?>"
                                          method="post" id="form_role">

                                        <div class="form-group">
                                            <label class="col-sm-1 control-label no-padding-right"
                                                   style="margin-top:13px;"> 原始密码 </label>
                                            <div class="col-sm-6">
                                                <input name="old_password" value="" placeholder="请填写原始密码"
                                                       class="form-control input-lg" type="password">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-1 control-label no-padding-right"
                                                   style="margin-top:13px;"> 新密码 </label>
                                            <div class="col-sm-6">
                                                <input name="new_password" value="" placeholder="请填写新密码"
                                                       class="form-control input-lg" type="password">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-sm-1 control-label no-padding-right"
                                                   style="margin-top:13px;"> 确认密码 </label>
                                            <div class="col-sm-6">
                                                <input name="con_password" value="" placeholder="请填写确认密码"
                                                       class="form-control input-lg" type="password">
                                            </div>
                                        </div>


                                        <div class="clearfix form-actions">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn btn-info" type="button" id="submit"> 确认修改</button>
                                            </div>
                                        </div>
                                        <div class="hr hr-24"></div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END RECENT PURCHASES -->
                </div>
            </div>
        </div>

<script>
    layui.use(['jquery', 'form'], function () {
        var $ = layui.jquery,
            form = layui.form,
            layer = layui.layer;

        $(function () {
            $("#submit").click(function () {

                var old_password = $('input[name="old_password"]').val();
                var new_password = $('input[name="new_password"]').val();
                var con_password = $('input[name="con_password"]').val();

                if (old_password == '' || new_password == '' || con_password == '') {
                    layer.msg('请认真填写表单信息');
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: $("#form_role").attr("action"),
                    dataType: 'json',
                    data: $('#form_role').serialize(),
                    success: function (data) {
                        if (data.status == 1) {
                            layer.msg(data.message, {
                                time: 1500
                            }, function () {
                                window.location.href = data.url;
                            });
                        } else {
                            layer.alert(data.message, {
                                icon: 0,
                                skin: 'layer-ext-moon'
                            }, function () {
                                window.location.reload();
                            });
                        }
                    }
                });
            });
        });
    });
</script>

        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
        <div class="container-fluid">
            <p class="text-left">Copyright &copy; <a href="http://www.zzsist.com/" target="_blank">2019.SIST</a></p>
        </div>
    </footer>
</div>

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
</body>
</html>