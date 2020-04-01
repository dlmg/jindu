<?php /*a:2:{s:78:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\project\detail.html";i:1585643287;s:75:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\public\base.html";i:1585644957;}*/ ?>
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
                            <li><a href="<?php echo url('index/index'); ?>"><i class="lnr lnr-user"></i><span>个人资料</span></a></li>
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
                    <li><a href="<?php echo url('index/index/about'); ?>" <?php if($action == 'about'): ?>class="active"<?php endif; ?>><i class="lnr lnr-code"></i> <span>关于SIST</span></a></li>
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
        
<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <div class="panel">

            <div class="layui-collapse" lay-accordion>

                <ul class="layui-timeline" style="margin-top:30px;">
                    项目进度：
                    <?php if(is_array($result) || $result instanceof \think\Collection || $result instanceof \think\Paginator): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?>
                    <li class="layui-timeline-item" style="margin-left:100px;">
                        <span style="float:left;margin-left:-70px;margin-top:10px;color:#25cee6;font-size: 18px;">第<?php echo htmlentities($result['buzhou']); ?>步</span><i
                            class="layui-icon layui-timeline-axis" style="margin-top:10px;">&#xe63f;</i>
                        <div class=" layui-colla-item " style="margin-left: 35px;margin-top:20px;">
                            <h2 class=" layui-colla-title" style="border:1px solid #eee;font-size: 16px;">
                                <?php echo htmlentities($result['buzhou']); ?>. &nbsp;<?php echo htmlentities($result['statusName']); ?>


                                <div style="float:right;font-size: 14px;">
                                    <?php if($result['is_right'] == 1): ?>
                                    <span style="color:#009900;">已完成&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <?php endif; ?>
                                    <?php echo htmlentities($result['create_time']); ?>
                                </div>
                            </h2>

                            <div class="layui-colla-content" style="height:auto;">
                                <?php if($result['buzhou'] > 2 && $result['is_goto'] == 1): ?>
                                <div style="float:right;width:auto;"><a
                                        href="<?php echo url('detailed',array('id'=>$result['buzhou'],'pro_id'=>$result['project_id'])); ?>">
                                    <button class="layui-btn layui-btn-normal" id="chakan">查看内容</button>
                                </a>
                                    <?php if($result['is_ready'] == 1 && $result['is_right'] == 0): ?>
                                    <input type="hidden" value="<?php echo htmlentities($result['buzhou']); ?>" id="buzhou">
                                    <input type="hidden" value="<?php echo htmlentities($result['project_id']); ?>" id="pro_id">
                                    <button class="layui-btn layui-btn-normal" id="queren">确认，下一步</button>
                                    <?php endif; ?>
                                </div>
                                <?php endif; if($result['is_right'] == 0 && $result['buzhou'] == 2): ?>
                                <div style="float:right;width:auto;">
                                    <button class="layui-btn layui-btn-normal" id="upload">上传需求</button>
                                    <input type="hidden" value="<?php echo htmlentities($result['buzhou']); ?>" id="buzhou">
                                    <input type="hidden" value="<?php echo htmlentities($result['project_id']); ?>" id="pro_id">
                                </div>
                                <?php endif; ?>
                                <ul>
                                    <?php if(is_array($operation) || $operation instanceof \think\Collection || $operation instanceof \think\Paginator): $i = 0; $__LIST__ = $operation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ope): $mod = ($i % 2 );++$i;if($result['buzhou'] == $ope['buzhou']): ?>
                                    <li style="margin-top:10px;"><span class="layui-badge-dot layui-bg-blue"></span>&nbsp;<span
                                            style="margin-left:10px;"><?php echo htmlentities($ope['create_time']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($ope['operation']); ?></span>
                                        <?php if($ope['url'] != null): ?>
                                        <br>
                                        <div style="background-color: lightgrey;width:auto;margin-left:20px;"><span style="color:#25cee6;font-size: 18px;"><?php echo htmlentities($ope['url']); ?></span></div>
                                        <div style="margin-top:5px;">上传描述：<span style="color:black;"><?php echo htmlentities($ope['description']); ?></span></div>
                                        <?php endif; ?>
                                    </li>

                                    <?php endif; ?>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

            </div>
        </div>
        <?php if($pj['status'] == 1): ?>
        <div class="layui-col-md12"
             style="border:1px solid grey;margin-bottom: 60px;">

            <div class="layui-card">
                <div class="layui-card-header" style="border:none;font-size: 15px;">该项目已完成，请您对本次项目作出评价</div>
                <hr class="layui-bg-black">
                <input type="hidden" id="pingfen" name="pingfen" value="">
                <input type="hidden" id="pro_id" name="pro_id" value="<?php echo htmlentities(app('request')->param('id')); ?>">
                <?php if($pj['is_evaluation'] == 0): ?>
                <div style="width:70%;margin:0 auto;">
                    <textarea name="pjnr" id="pjnr" placeholder="您的评价是对我们工作的最大肯定" class="layui-textarea" style="resize: none;"></textarea>
                    <input type="hidden" id="fenshu" value="<?php echo htmlentities($pj['score']); ?>">
                    <div id="score">
                    </div>
                </div>
                <div class="layui-card-body">
                    <button class="layui-btn layui-btn-normal" id="pingjia">提交评价</button>
                </div>
                <?php else: ?>
                <div class="layui-card-body">
                    您的评价：
                    <input type="hidden" id="fenshu" value="<?php echo htmlentities($pj['score']); ?>">
                    <div style="width:80%;"><span><pre><?php echo htmlentities($pj['evaluation']); ?></pre></span></div>
                    <div id="score1">
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <script>
            //注意：折叠面板 依赖 element 模块，否则无法进行功能性操作
            layui.use(['element', 'layer', 'rate'], function () {
                var element = layui.element,
                    layer = layui.layer,
                    rate = layui.rate;
                rate.render({
                    elem: '#score'
                    , value: 0//初始值
                    , text: true //开启文本
                    , setText: function (value) {
                        var arrs = {
                            '1': '极差'
                            , '2': '差'
                            , '3': '中等'
                            , '4': '好'
                            , '5': '非常好'
                        };
                        this.span.text(arrs[value] || (value + "星"));
                        $('#pingfen').val(value);
                    }
                });

                rate.render({
                    elem: '#score1'
                    , value: $('#fenshu').val()//初始值
                    , text: true //开启文本
                    ,readonly:true
                    , setText: function (value) {
                        var arrs = {
                            '1': '极差'
                            , '2': '差'
                            , '3': '中等'
                            , '4': '好'
                            , '5': '非常好'
                        };
                        this.span.text(arrs[value] || (value + "星"));
                    }
                });

                $('#pingjia').on('click', function () {
                    var index = layer.confirm('点击确认后将进行评价！', {
                        icon: 3
                    }, function (index) {
                        var loading = layer.msg('处理中，请稍后...', {
                            icon: 16,
                            shade: 0.5
                        });
                        $.ajax({
                            url: '<?php echo url("score"); ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                pro_id: function () {
                                    return $('#pro_id').val();
                                },
                                pingfen: function () {
                                    return $('#pingfen').val();
                                },
                                text:function () {
                                    return $('#pjnr').val();
                                }

                            },
                            success: function (res) {
                                //layer.close(loading);
                                if (res.status == 200) {
                                    layer.msg(res.message, {
                                        time: 1000
                                    }, function () {
                                        window.location.href = '<?php echo url("index"); ?>';
                                    });
                                } else if (res.status == 201) {
                                    layer.alert(res.message, {
                                        icon: 2,
                                        skin: 'layer-ext-moon'
                                    }, function () {
                                        parent.window.location.reload();
                                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                                        parent.layer.close(index);
                                    });
                                }
                            }
                        });
                    })
                });

                // 上传需求
                $('#upload').on('click', function () {
                    var index = layer.open({
                        type: 2,
                        title: '<i class=iconfont>&#xe7c7;</i> 上传需求',
                        area: ['700px', '650px'],
                        content: ['<?php echo url("project/upload"); ?>?buzhou=' + $("#buzhou").val() + "&pro_id=" + $("#pro_id").val()],
                        skin: 'layui-layer-molv',
                        //btn: ['立即提交', '重置'],
                        btnAlign: 'c',
                        yes: function (index, layero) {
                            var submit = layero.find('iframe').contents().find("#submit");// #subBtn为页面层提交按钮ID
                            submit.click();// 触发提交监听
                            return false;
                        },
                        btn2: function (index, layero) {
                            var reset = layero.find('iframe').contents().find("#reset");// #subBtn为页面层提交按钮ID
                            reset.click();// 触发重置按钮
                            return false;
                        }
                    });
                });
                $('#queren').on('click', function () {
                    var index = layer.confirm('点击确认后将进行下一步！', {
                        icon: 3
                    }, function (index) {
                        var loading = layer.msg('处理中，请稍后...', {
                            icon: 16,
                            shade: 0.5
                        });
                        $.ajax({
                            url: '<?php echo url("project/next"); ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                pro_id: function () {
                                    return $('#pro_id').val();
                                },
                                buzhou: function () {
                                    return $('#buzhou').val();
                                }
                            },
                            beforeSend: function () {
                            },
                            success: function (res) {
                                layer.close(loading);
                                if (res.status == 1) {
                                    layer.msg(res.message, {
                                        time: 1000
                                    }, function () {
                                        window.location.reload();
                                    });
                                } else if (res.status == 0) {
                                    layer.alert(res.message, {
                                        icon: 2,
                                        skin: 'layer-ext-moon'
                                    }, function () {
                                        parent.window.location.reload();
                                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                                        parent.layer.close(index);
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