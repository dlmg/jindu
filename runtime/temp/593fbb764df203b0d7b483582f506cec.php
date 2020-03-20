<?php /*a:1:{s:75:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\login\index.html";i:1584178924;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>赛思特以太坊项目管理平台-登录</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" type="text/css" href="/static/css/public/public.css" />
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/iconfont/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/admin/login.css" />
</head>
<body>
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <h1>欢迎登录</h1>
                            </div>
                            <p>赛思特项目管理系统</p>
                        </div>

                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <div style="text-align: center;margin:70px;">
                                <img src="/static/images/logo.png" width="130">
                            </div>
                            <form method="post" action="<?php echo url('index/login/check'); ?>" class="form-validate"
                                  id="loginForm">
                                <div class="form-group">
                                    <input id="login-username" type="text" name="username" required data-msg="请输入用户名"
                                           placeholder="用户名" class="input-material">
                                </div>
                                <div class="form-group">
                                    <input id="login-password" type="password" name="password" required data-msg="请输入密码"
                                           placeholder="密码" class="input-material">
                                </div>

                                <div class="form-group">
                                    <input id="login-verify" type="text" name="verify" required data-msg="请输入验证码"
                                           placeholder="验证码" class="input-material">
                                    <div><img src="<?php echo url('login/verify'); ?>" alt="captcha"
                                              onclick="this.src='<?php echo url('login/verify'); ?>?'+Math.random();"></div>
                                </div>
                                <div class="layui-form-item ">
                                    <button type="submit" class="layui-btn layui-btn-fluid" lay-submit lay-filter="submit">登 录</button>
                                </div>
                                <div style="margin-top: -40px;">
                                    <!-- <input type="checkbox"  id="check1"/>&nbsp;<span>记住密码</span>
                                    <input type="checkbox" id="check2"/>&nbsp;<span>自动登录</span> -->
                                    <!--<div class="custom-control custom-checkbox " style="float: right;">
                                        <input type="checkbox" class="custom-control-input" id="check2" >
                                        <label class="custom-control-label" for="check2">自动登录</label>
                                    </div>
                                    <div class="custom-control custom-checkbox " style="float: right;">
                                        <input type="checkbox" class="custom-control-input" id="check1" >
                                        <label class="custom-control-label" for="check1">记住密码&nbsp;&nbsp;</label>
                                    </div>-->
                                </div>
                            </form>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<!-- JavaScript files-->
<script>
    layui.config({
        version: '1061458899',
        base: '/static/layui_exts/'
    }).extend({
        ztree : 'ztree/ztree'
    });
    layui.use(['jquery', 'form'], function () {
        var $ = layui.jquery,
            form = layui.form;

        // 提交表单
        form.on('submit(submit)',function(data){
            // 加载层
            var loading = layer.msg('登录中，请稍后...', {
                icon: 16,
                offset: '300px',
                shade: 0.2
            });
            $.ajax({
                type: "post",
                url: "<?php echo url('login/check'); ?>",
                data: $('#loginForm').serialize(),
                dataType: 'json',
                beforeSend: function(){},
                success: function (data) {
                    layer.close(loading);
                    switch (data.status)
                    {
                        case 1:
                            layer.msg(data.message, {
                                offset: '300px',
                                icon: 1,
                                time: 1500
                            },function(){
                                location.href = data.url;
                            });
                            break;
                        case 0:
                        case -1:
                        case -2:
                            layer.msg(data.message, {
                                offset: '300px',
                                icon: 0,
                                time: 1500
                            }, function() {
                                location.href = data.url;
                            });
                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>