<?php /*a:2:{s:78:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\project\detail.html";i:1584340349;s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\public\layout.html";i:1584093377;}*/ ?>
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
<body class="layui-layout-body">
    <div class="layui-card">
        <div class="layui-card-header">
            <i class="iconfont">&#xe755;</i> <?php echo htmlentities($title); ?></i>
        </div>
        <div class="layui-card-body">
            

<div class="layui-collapse">
    <?php if(is_array($result) || $result instanceof \think\Collection || $result instanceof \think\Paginator): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?>
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">第<?php echo htmlentities($result['buzhou']); ?>步 &nbsp;&nbsp;&nbsp;<?php echo htmlentities($result['statusName']); ?></h2>
        <?php if($result['buzhou'] == 1): ?>
        <div class="layui-colla-content layui-show"><?php echo htmlentities($result['operation']); ?></div>
        <?php else: ?>
        <div class="layui-colla-content"><?php echo htmlentities($result['operation']); ?></div>
        <?php endif; ?>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>

        </div>
    </div>

    
    <script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>

    
    
    
<script>
    //注意：折叠面板 依赖 element 模块，否则无法进行功能性操作
    layui.use('element', function(){
        var element = layui.element;

        //…
    });
</script>

</body>
</html>