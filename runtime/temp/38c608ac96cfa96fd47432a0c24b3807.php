<?php /*a:2:{s:85:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\project\communication.html";i:1585214887;s:83:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\public\layer_layout.html";i:1584093394;}*/ ?>
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
    layui.use('upload', function(){
        var $ = layui.jquery,
            upload = layui.upload;

        //执行实例
        //普通图片上传
        upload.render({
            elem: '#test2'
            ,url: '<?php echo url("project/doCommunication"); ?>' //改成您自己的上传接口
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

</body>
</html>