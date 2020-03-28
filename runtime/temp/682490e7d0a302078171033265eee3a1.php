<?php /*a:2:{s:78:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\project\detail.html";i:1585359329;s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\public\layout.html";i:1585275795;}*/ ?>
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
            
<div class="layui-collapse" style="width:98%;">
    <ul class="layui-timeline" style="margin-top:30px;">

        <?php if(is_array($result) || $result instanceof \think\Collection || $result instanceof \think\Paginator): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?>
        <li class="layui-timeline-item" style="margin-left:100px;">
           <span style="float:left;margin-left:-70px;margin-top:10px;color:#25cee6;font-size: 18px;">第<?php echo htmlentities($result['buzhou']); ?>步</span><i class="layui-icon layui-timeline-axis" style="margin-top:10px;">&#xe63f;</i>
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
                    <div style="float:right;width:auto;"><a href="<?php echo url('detailed',array('id'=>$result['buzhou'],'pro_id'=>$result['project_id'])); ?>"><button  class="layui-btn layui-btn-normal" id="chakan">查看内容</button></a>
                        <?php if($result['is_ready'] == 0): ?>
                        <button  class="layui-btn layui-btn-normal" id="yes">完成</button>
                        <?php else: ?>
                        <button type="button" class="layui-btn layui-btn-disabled">已完成</button>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <ul>
                        <?php if(is_array($operation) || $operation instanceof \think\Collection || $operation instanceof \think\Paginator): $i = 0; $__LIST__ = $operation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ope): $mod = ($i % 2 );++$i;if($result['buzhou'] == $ope['buzhou']): ?>
                        <li style="margin-top:10px;"><span class="layui-badge-dot layui-bg-blue"></span>&nbsp;<span style="margin-left:10px;"><?php echo htmlentities($ope['create_time']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($ope['operation']); ?></span>
                            <?php if($ope['url'] != null): ?>
                            <br><div style="background-color: lightgrey;width:auto;margin-left:20px;"><span style="color:#25cee6;font-size: 18px;"><?php echo htmlentities($ope['url']); ?></span></div>
                            <div style="margin-top:5px;">上传描述：<span style="color:black;"><?php echo htmlentities($ope['description']); ?></span></div>
                            <?php endif; if($ope['file_url'] != null): ?>
                            <span><a href="<?php echo url('admin/project/download'); ?>?id=<?php echo htmlentities($ope['id']); ?>">点击此处下载</a></span>
                            <br>上传描述：<div style="background-color: darkgrey;font-size: 15px;"><span style="color:#123456;"><?php echo htmlentities($ope['description']); ?></span></div>
                            <?php endif; ?>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <?php if($result['buzhou'] > 1): ?>
                    <div style="float:right;">

                        <?php if($result['buzhou'] > 2 && $result['is_right'] == 0): ?>
                        <div>
                            <input type="hidden" value="<?php echo htmlentities($result['buzhou']); ?>" id="buzhou">
                            <input type="hidden" value="<?php echo htmlentities($result['project_id']); ?>" id="pro_id">
                            <input type="hidden" value="<?php echo htmlentities($result['statusName']); ?>" id="statusName">
                        <?php if($result['is_goto'] == 0): ?>
                            <button  class="layui-btn layui-btn-normal" id="goto">进入此步骤</button>
                            <?php endif; ?>

                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>


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
                area: ['1000px', '840px'],
                content: ['<?php echo url("project/done"); ?>?buzhou='+$("#buzhou").val()+"&pro_id="+$("#pro_id").val()],
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

        $('#yes').on('click', function () {
            var index = layer.open({
                type: 2,
                title: '<i class=iconfont>&#xe7c7;</i> 完成说明',
                area: ['90%', '90%'],
                content: ['<?php echo url("project/done"); ?>?buzhou='+$("#buzhou").val()+"&pro_id="+$("#pro_id").val()],
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

        $('#goto').on('click',function () {
            var pro_id = document.getElementById("pro_id").value;
            var buzhou = document.getElementById("buzhou").value;
            var statusName = document.getElementById("statusName").value;
            $.ajax({
                url:"<?php echo url('next'); ?>",
                data:{pro_id:pro_id,buzhou:buzhou,statusName:statusName},
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
        })
    });
</script>


</body>
</html>