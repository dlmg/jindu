<?php /*a:2:{s:74:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\project\bz.html";i:1584515891;s:77:"D:\phpstudy_pro\WWW\ThinkPHP5.1RBAC\application\admin\view\public\layout.html";i:1585275795;}*/ ?>
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
            

<table class="layui-hide" id="dataTable" lay-filter="dataTable"></table>

<script type="text/html" id="toolbar">
    <div class="dataToolbar">
        <div class="layui-inline">
            <input class="layui-input" name="keywords" id="keywords" value="<?php echo input('keywords'); ?>" autocomplete="on" placeholder="请输入项目名称">
        </div>
        <button class="layui-btn search-btn" data-type="reload"><i class="iconfont">&#xe679;</i> 查询</button>
    </div>
</script>


<script type="text/html" id="barTool">

    <a href="javascript:;" lay-event="edit" class="layui-btn layui-btn-xs"><i class="iconfont">&#xe7e0;</i>编辑</a>
    <!--<a href='javascript:;' lay-event="del" class="layui-btn layui-btn-danger layui-btn-xs"><i class="iconfont">&#xe6b4;</i> 编辑</a>-->
</script>


<script type="text/html" id="status">
    {{# if(d.login_status == 1){ }}
    <button class="layui-btn layui-btn-xs layui-btn-success">登录成功</button>
    {{# } else { }}
    <button class="layui-btn layui-btn-xs layui-btn-danger">登录失败</button>
    {{# } }}
</script>

        </div>
    </div>

    
    <script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>

    
    
    
<script>
    layui.use(['jquery', 'layer', 'form', 'table','layer'], function () {
        var $ = layui.$,
            layer = layui.layer,
            form = layui.form,
            layer = layui.layer,
            table = layui.table;

        // 时间戳的处理
        layui.laytpl.toDateString = function(d, format){
            var date = new Date(d || new Date())
                ,ymd = [
                this.digit(date.getFullYear(), 4)
                ,this.digit(date.getMonth() + 1)
                ,this.digit(date.getDate())
            ]
                ,hms = [
                this.digit(date.getHours())
                ,this.digit(date.getMinutes())
                ,this.digit(date.getSeconds())
            ];

            format = format || 'yyyy-MM-dd HH:mm:ss';

            return d ? format.replace(/yyyy/g, ymd[0])
                .replace(/MM/g, ymd[1])
                .replace(/dd/g, ymd[2])
                .replace(/HH/g, hms[0])
                .replace(/mm/g, hms[1])
                .replace(/ss/g, hms[2]) : '';
        };
        // 数字前置补零
        layui.laytpl.digit = function(num, length, end){
            var str = '';
            num = String(num);
            length = length || 2;
            for(var i = num.length; i < length; i++){
                str += '0';
            }
            return num < Math.pow(10, length) ? str + (num|0) : num;
        };

        // 渲染数据表格
        table.render({
            elem : '#dataTable'
            ,url : '<?php echo url("bzList"); ?>'
            ,cellMinWidth: 240
            /*,page: {
                prev: '上一页',
                next: '下一页',
                layout: ['prev', 'page', 'next', 'skip', 'count', 'limit']
            }*/
            // ,toolbar: 'default'  // 开启顶部工具栏（默认模板）
            ,toolbar: '#toolbar' // 指定顶部工具栏模板
            ,even: true  // 隔行背景
            ,title: '我的项目列表'  // 表格标题，用户导出数据文件名
            ,text: {  // 指定无数据或数据异常时的提示文本
                none: '暂无相关数据' //默认：无数据。注：该属性为 layui 2.2.5 开始新增
            }
            ,id: 'dataTable'
            ,cols: [[  // 表格列标题及数据
                {title: '序号', type: 'numbers'}
                ,{field: 'id', width: 150, title: '步骤', align: 'center',width:'300',templet:'#idTpl'}
                ,{field: 'statusName', width: 150, title: '步骤名称', align: 'center',width:'300'}
                ,{fixed: 'right', width: 200, title: '操作', align:'center', toolbar: '#barTool',width:'300'}

            ]], done() {
                // 搜索功能
                var $ = layui.$, active = {
                    reload: function(){
                        var keywords = $('#keywords');
                        //执行重载
                        table.reload('dataTable', {
                            page: {
                                curr: 1 //重新从第 1 页开始
                            }
                            ,where: {
                                keywords: keywords.val()
                            }
                        }, 'data');
                    }
                };

                $('.search-btn').on('click', function(){
                    var type = $(this).data('type');
                    active[type] ? active[type].call(this) : '';
                });
            }
        });

        $('#layerDemo .layui-btn').on('click', function(){
            var othis = $(this), method = othis.data('method');
            active[method] ? active[method].call(this, othis) : '';
        });


        // 监听行内工具栏
        table.on('tool(dataTable)', function (obj) {
            var e = obj.event;
            var data = obj.data;

            if(e === 'edit'){
                var index=layer.open({
                    type: 2,
                    title: '<i class=iconfont>&#xe7e0;</i> 编辑步骤',
                    area: ['500px', '400px'],
                    content: ['<?php echo url("project/edit"); ?>?id=' + data.id, 'yes'],
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
                })
            }

        });
    });
</script>
<script type="text/html" id="zhuangtai">
    {{# if(d.status==0){d.status='正在进行' }}
    <span>{{d.status}}</span>
    {{#  }else{d.status='已经完成'}}
    {{d.status}}
    {{# } }}
</script>

</body>
</html>