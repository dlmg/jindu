<?php /*a:3:{s:73:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\user\edit.html";i:1584441723;s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\public\header.html";i:1584417627;s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\public\footer.html";i:1584440074;}*/ ?>
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
<form class="layui-form" id="form1" lay-filter="component-form-element" style="margin-top:10px;">
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
<script>
    layui.use(['form', 'jquery','layer'], function () {
        var form = layui.form,
            $ = layui.$,
            layer = layui.layer;

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
                        url: '<?php echo url("user/doEditPwd"); ?>',
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