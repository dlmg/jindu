<?php /*a:2:{s:82:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\index\editpassword.html";i:1584091919;s:83:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\public\layer_layout.html";i:1584093394;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:"")); ?></title>
    
    <link rel="stylesheet" type="text/css" href="/static/css/public/public.css" />
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/admin/layuimini.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/iconfont/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/admin/admin.css" />
    
</head>
<body id="layer">
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body">
                    
<form class="layui-form" id="form1" lay-filter="component-form-element">
    <div class="layui-row layui-col-space10 layui-form-item">
        <div class="layui-form-item">
            <label class="layui-form-label">用户名：</label>
            <div class="layui-input-block">
                <input type="text" name="username" class="layui-input input-disable" disabled value="<?php echo htmlentities($username); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">原密码：</label>
            <div class="layui-input-block">
                <input type="password" name="original_password" placeholder="请输入原密码" autocomplete="off" lay-verify="required" lay-reqText="原密码不能为空" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">新密码：</label>
            <div class="layui-input-block">
                <input type="password" name="password" placeholder="请输入新密码" autocomplete="off" lay-verify="required" lay-reqText="新密码不能为空" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">确认密码：</label>
            <div class="layui-input-block">
                <input type="password" name="confirm_password" placeholder="请再次输入新密码" autocomplete="off" lay-verify="required" lay-reqText="确认密码不能为空" class="layui-input">
            </div>
        </div>

        <input type="hidden" name="id" value="<?php echo htmlentities($id); ?>">

        <div class="layui-form-item layui-hide">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" id="submit" lay-submit lay-filter="submit">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary" id="reset">重置</button>
            </div>
        </div>
</form>

                </div>
            </div>
        </div>
    </div>

    
    <script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <script type="text/javascript" src="/static/js/admin/layout.js"></script>
    

    
    
    
    <script>
        layui.use(['element', 'layer', 'layuimini'], function () {
            var $ = layui.jquery,
                element = layui.element,
                layer = layui.layer;
            layuimini.init('');
        });
        function editPwd() {
            layer.open({
                type: 2,
                title: '修改密码',
                shade: 0.6,
                area: ['40%', '50%'],
                content: '<?php echo url("index/editPwd"); ?>'
            });
        }
    </script>
    
    
<script>
    layui.use(['form', 'jquery'], function () {
        var form = layui.form,
            $ = layui.$;

        form.on('submit(submit)',function(data){
            if ( $('input[name=password]').val() != '' && $('input[name=confirm_password]').val() != '' ) {
                if ( $('input[name=password]').val() != $('input[name=confirm_password]').val() ) {
                    layer.msg('两次输入的密码不一致，请重新输入', {
                        time: 1500
                    });
                    return false;
                } else {
                    // 加载层
                    var loading = layer.msg('处理中，请稍后...', {
                        icon: 16,
                        shade: 0.2
                    });
                    $.ajax({
                        url: '<?php echo url("doEditPwd"); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: $('#form1').serialize(),
                        beforeSend: function(){},
                        success: function(data){
                            layer.close(loading);
                            if (data.status == 1) {
                                layer.msg(data.message, {
                                    time: 1500
                                },function(){
                                    parent.window.location.reload();
                                    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                                    parent.layer.close(index);
                                });
                            } else if (data.status == -1) {
                                layer.alert(data.message, {
                                    icon: 0,
                                    skin: 'layer-ext-moon'
                                }, function() {
                                    window.location.reload();
                                });
                            } else if (data.status == 0) {
                                layer.alert(data.message, {
                                    icon: 2,
                                    skin: 'layer-ext-moon'
                                },function(){
                                    window.location.reload();
                                });
                            }
                        }
                    });
                    return false;
                }
            }
        });
    });
</script>

</body>
</html>