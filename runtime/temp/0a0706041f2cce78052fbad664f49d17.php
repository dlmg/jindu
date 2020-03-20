<?php /*a:1:{s:75:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\login\index.html";i:1584094516;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:"ThinkPHP5.1 RBAC权限管理系统")); ?></title>
    
    <link rel="stylesheet" type="text/css" href="/static/css/public/public.css" />
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/iconfont/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/admin/login.css" />
</head>
<body>
    <div id="login">
        <div class="login-wrap">
            <h2>ThinkPHP 5.1 RBAC权限管理</h2>
            <h3>管理员登录</h3>
            <form id="form1" method="post" class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label"><i class="layui-icon layui-icon-username"></i></label>
                    <input type="text" class="layui-input" name="username" lay-verify="required" lay-reqText="用户名不能为空" value="admin">
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><i class="layui-icon layui-icon-password"></i></label>
                    <input type="text" class="layui-input" name="password" lay-verify="required" lay-reqText="密码不能为空" value="admin">
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><i class="layui-icon layui-icon-vercode"></i></label>
                    <input type="text" class="layui-input captcha" name="captcha" lay-verify="required" lay-reqText="验证码不能为空">
                    <div class="cpatcha-img">
                        <img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src=this.src+'?'"/>
                    </div>
                </div>
                <div class="layui-form-item ">
                    <button type="submit" class="layui-btn layui-btn-fluid" lay-submit lay-filter="submit">登 录</button>
                </div>
            </form>
            <p class="copyright">Powered by <a href="https://www.zhangshaoping.com">郑州赛思特</a></p>
        </div>
    </div>

    
    <script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>

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
                    url: "<?php echo url('login/checkLogin'); ?>",
                    data: $('#form1').serialize(),
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