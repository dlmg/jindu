<?php /*a:2:{s:80:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\project\detailed.html";i:1585357795;s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\public\layout.html";i:1585275795;}*/ ?>
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
    <link rel="stylesheet" type="text/css" href="/static/css/iconfont/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/admin/admin.css" />
    
    
</head>
<body>
    <div class="layui-card">
        <div class="layui-card-header">
            <i class="iconfont">&#xe755;</i> <?php echo htmlentities($title); ?></i>
        </div>
        <div class="layui-card-body">
            
<div style="float:right;"><button class="layui-btn layui-btn-normal" id="upload">沟通</button></div>
<div class="layui-collapse" style="width:98%;">
    <input type="hidden" value="<?php echo htmlentities($buzhou); ?>" id="buzhou">
    <input type="hidden" value="<?php echo htmlentities($pro_id); ?>" id="pro_id">

    <ul class="layui-timeline">

        <?php if(is_array($result) || $result instanceof \think\Collection || $result instanceof \think\Paginator): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <li class="layui-timeline-item">
            <i class="layui-icon layui-timeline-axis"></i>
            <div class="layui-timeline-content layui-text">
                <h3 class="layui-timeline-title"><?php echo htmlentities($v['create_time']); ?>&nbsp;&nbsp;<span><?php echo htmlentities($v['operation']); ?></span></h3>
                <p>
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($v['create_time'] == $vo['create_time']): if($vo['is_image'] == 1): ?>
                    <span><img src="/upload/<?php echo htmlentities($vo['file_url']); ?>" width="216" title="可右键另存为" alt="上传的图片被意大利炮轰走了"></span>
                    <?php else: ?>
                    <span><a href="<?php echo url('admin/project/downloadDt'); ?>?id=<?php echo htmlentities($vo['id']); ?>">点击此处下载文档</a></span>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; endif; else: echo "" ;endif; if($v['upload_desc'] != null): ?>
                    <br>上传描述：<div style="background-color: darkgrey;font-size: 15px;width:70%"><span style="color:#123456;"><pre><?php echo htmlentities($v['upload_desc']); ?></pre></span></div>
                <br><br>
                <?php else: ?>
                <br><br>
                <?php endif; ?>
                </p>
            </div>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>

        </div>
    </div>

    
    <script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>

    
    
    
<script>
    layui.use(['element', 'layer'],function(){
        var element = layui.element,
            layer = layui.layer,
            $ = layui.jquery;

        $('#upload').on('click', function () {
            var index = layer.open({
                type: 2,
                title: '<i class=iconfont>&#xe7c7;</i> 上传文件',
                area: ['800px', '640px'],
                content: ['<?php echo url("project/communication"); ?>?buzhou='+$("#buzhou").val()+"&pro_id="+$("#pro_id").val()],
                skin: 'layui-layer-molv',
                //btn: ['立即提交', '重置'],
                btnAlign: 'c',
                yes: function(index, layero){
                    var submit = layero.find('iframe').contents().find("#submit");// #subBtn为页面层提交按钮ID
                    submit.click();// 触发提交监听
                    return false;
                },
                btn2:function (index,layero) {
                    var reset = layero.find('iframe').contents().find("#reset");// #subBtn为页面层提交按钮ID
                    reset.click();// 触发重置按钮
                    return false;
                }
            });
        });
    });
</script>


</body>
</html>