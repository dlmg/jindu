<?php /*a:2:{s:76:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\project\done.html";i:1585296749;s:83:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\public\layer_layout.html";i:1584093394;}*/ ?>
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
                    
<table width="70%">
    <tr><td width="20%" align="center">查看链接:</td>
        <td width="80%">
            <input type="text" name="url" id="url" style="text-decoration:underline;width:300px;" placeholder="请点击此处输入链接，若无则忽略">
        </td>
    </tr>
                <input type="hidden" value="<?php echo htmlentities($buzhou); ?>" id="buzhou">
                <input type="hidden" value="<?php echo htmlentities($pro_id); ?>" id="pro_id">
    <tr><td width="30%" align="center">完成说明：</td><td width="70%"><textarea name="description" style="margin-top:80px;resize: none;" maxlength="200" width="60%" required lay-verify="required" rows="10" placeholder="请输入上传备注,限制在200字以内" class="layui-textarea" id="description"></textarea></tr>
    <tr><td></td>
        <td><div style="margin-top:40px;">
            <button type="button" class="layui-btn" id="action">提交</button>
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
        var element = layui.element,
            layer = layui.layer,
            $ = layui.jquery;


        $('#action').on('click',function () {
            var pro_id = document.getElementById("pro_id").value;
            var buzhou = document.getElementById("buzhou").value;
            var description = document.getElementById('description').value;
            var url = document.getElementById('url').value;
            if(isnull(description)){
            $.ajax({
                url:"<?php echo url('done'); ?>",
                data:{pro_id:pro_id,buzhou:buzhou,description:description,url:url},
                type:'post',
                success: function(res){
                    //layer.close(loading);
                    if (res.status == 1) {
                        layer.msg(res.message, {
                            time: 1000
                        },function(){
                            window.location.reload();
                        });
                    } else if (res.status == 0) {
                        layer.alert(res.message, {
                            icon: 2,
                            skin: 'layer-ext-moon'
                        },function(){
                            parent.window.location.reload();
                            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                            parent.layer.close(index);
                        });
                    }
                }
            })
            }
        });

        function isnull(val) {
            var str = val.replace(/(^\s*)|(\s*$)/g, '');

            if (str == '' || str == undefined || str == null) {
                layer.msg('完成说明不能为空');
            } else {
                return true;

            }
        }
    });
</script>

</body>
</html>