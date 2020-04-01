<?php /*a:3:{s:85:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\project\communication.html";i:1585281333;s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\public\header.html";i:1585379478;s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\index\view\public\footer.html";i:1585535326;}*/ ?>
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
    <style>
        body{
            font-size: 15px;
        }
        </style>
</head>


<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel">
                <div class="layui-collapse" style="width:98%;">
                    <table style="margin:0 auto;" width="100%" height="60%" >
                        <tr>
                            <td></td>
                            <td>
                                <div class="layui-upload">
                                    <button type="button" class="layui-btn" id="test2">文件上传</button>
                                </div>

                                <input type="hidden" value="<?php echo htmlentities($buzhou); ?>" id="buzhou">
                                <input type="hidden" value="<?php echo htmlentities($pro_id); ?>" id="pro_id">
                            </td>
                        </tr>
                        <tr>
                            <td>上传描述</td>
                            <td>
                                <textarea name="description" style="margin-top:80px;resize: none;" maxlength="200" width="60%" required lay-verify="required" rows="10" placeholder="请输入上传备注,限制在200字以内" class="layui-textarea" id="description"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><div style="margin-top:40px;">
                                <button type="button" class="layui-btn" id="action">开始上传</button>
                            </div></td>
                        </tr>
                    </table>
                </div>

                <footer>
    <div class="footer">
        <p class="text-left">Copyright &copy; <a href="http://www.zzsist.com/" target="_blank">2019.SIST</a></p>
    </div>
</footer>
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
                    layui.use('upload', function(){
                        var $ = layui.jquery,
                            upload = layui.upload;

                        //执行实例
                        //普通图片上传
                        upload.render({
                            elem: '#test2'
                            ,url: '<?php echo url("index/project/doCommunication"); ?>' //改成您自己的上传接口
                            ,data:{
                                pro_id:function () {
                                    return $("#pro_id").val();
                                },
                                buzhou:function () {
                                    return $("#buzhou").val();
                                },
                                description:function () {
                                    return $("#description").val();
                                }
                            }
                            ,accept: 'file' //普通文件
                            ,multiple: true
                            ,auto:false
                            ,bindAction:'#action'
                            ,before: function(obj){
                                //预读本地文件示例，不支持ie8
                                obj.preview(function(index, file, result){
                                    $('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
                                });
                            }
                            ,done: function(res) {
                                if (res.code > 0) {
                                    return layer.msg('上传失败');
                                }
                                //上传成功
                                layer.msg('上传成功', {
                                    time: 1500
                                }, function () {
                                    parent.window.location.reload();
                                    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                                    parent.layer.close(index);
                                });
                            }
                            ,error: function(){
                                //演示失败状态，并实现重传
                                var demoText = $('#demoText');
                                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                                demoText.find('.demo-reload').on('click', function(){
                                    uploadInst.upload();
                                });
                            }
                        });
                    });

                </script>