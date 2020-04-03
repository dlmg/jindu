<?php /*a:2:{s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\project\index.html";i:1585639894;s:75:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\public\base.html";i:1585903555;}*/ ?>
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
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><?php echo htmlentities(app('request')->session('name')); ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url('index/index/index'); ?>"><i class="lnr lnr-user"></i><span>个人资料</span></a></li>
                            <li><a href="javascript:;" class="login-out" onclick="logout()"><i class="lnr lnr-exit"></i> <span>退出登录</span></a></li>
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
                    <li><a href="javascript:;" class="login-out" onclick="logout()"><i class="lnr lnr-exit"></i> <span>退出登录</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- END LEFT SIDEBAR -->
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT 模板继承-->
        
<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <div class="panel">

            <?php if($count != null): ?>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6"><span class="panel-note"> <h3 class="panel-title">当前您有<?php echo htmlentities($count); ?>个项目</h3></span>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="panel-heading">
                <h3 class="panel-title">当前您还没有项目</h3>
            </div>
            <?php endif; ?>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>项目名称</th>
                        <th>提交时间</th>
                        <th>项目状态</th>
                        <th>查看</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $kkk = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($kkk % 2 );++$kkk;?>
                    <tr>
                        <td><?php echo htmlentities($kkk); ?></td>
                        <td><?php echo htmlentities($data['proName']); ?></td>
                        <td><?php echo htmlentities($data['create_time']); ?></td>
                        <?php if($data['status']==0): ?>
                        <td><span class="label label-warning">等待审核</span></td>
                        <td></td>
                        <?php elseif($data['status']==1): ?>
                        <td><span class="label label-success">已完成</span></td>
                        <td><a href="<?php echo url('project/detail',array('id'=>$data['id'])); ?>">查看详情</a></td>
                        <?php else: ?>
                        <td><span class="label label-info">正在进行中</span></td>
                        <td><a href="<?php echo url('project/detail',array('id'=>$data['id'])); ?>">查看详情</a></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    
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
        layui.use(['element', 'layer', 'layuimini'], function () {
            var $ = layui.jquery,
                element = layui.element,
                layer = layui.layer;
            layuimini.init('');

        });
        // 退出登录
        function logout() {
            layer.confirm('您确定要退出吗？',{
                icon: 3,
                skin: 'layer-ext-moon'
            },function(index){
                window.location = '<?php echo url("login/logout"); ?>';
            });
        }


    </script>
</body>
</html>