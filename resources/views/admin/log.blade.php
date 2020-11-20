<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="{{asset('X-Admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('X-Admin/css/xadmin.css')}}">
    <script src="{{asset('X-Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('X-Admin/js/xadmin.js')}}"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('X-Admin/js/html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('X-Admin/js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body>
<div class="x-nav">
    <a class="layui-btn" href="{{url('admin/index')}}" ><i class="layui-icon"></i>返回</a>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" action="{{url('admin/log')}}" method="get">
                        <div class="layui-input-inline">
                            <select name="num" >
                                <option value="3" @if($request->input['num'==3]) selected @endif>3</option>
                                <option value="5" @if($request->input['num'==5]) selected @endif>5</option>
                            </select>
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input class="layui-input" autocomplete="off" placeholder="开始日" name="startdate" id="start"></div>=>
                        <div class="layui-inline layui-show-xs-block">
                            <input class="layui-input" autocomplete="off" placeholder="截止日" name="enddate" id="end"></div>
                        <div class="layui-inline layui-show-xs-block">
                            {{csrf_field()}}
                            <input type="text" name="username"  value="{{$request->input['admin_id']}}" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-body layui-table-body layui-table-main">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" lay-filter="checkall" name="" lay-skin="primary">
                            </th>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>IP</th>
                            <th>地址</th>
                            <th>时间</th>
                            <th>路由</th>
                        </thead>
                        <tbody>
                        @foreach($log as $val)
                            <tr>
                                <td>
                                    <input type="checkbox" name="checkedId" value="{{$val->id}}"   lay-skin="primary">
                                </td>
                                <td>{{$val->id}}</td>
                                <td>{{$val->admin_id}}</td>
                                <td>{{$val->ip}}</td>
                                <td>{{$val->address}}</td>
                                <td>{{$val->time}}</td>
                                <td>{{$val->url}}</td>

                                {{--     <td class="td-manage">
                                         --}}{{--                                <a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">--}}{{--
                                         --}}{{--                                    <i class="layui-icon">&#xe601;</i>--}}{{--
                                         --}}{{--                                </a>--}}{{--
                                         <a title="授权"   href="{{url('admin/user/auth/'.$val->id)}}">
                                             <i class="layui-icon">&#xe612;</i>
                                         </a>
                                         <a title="编辑"  onclick="xadmin.open('编辑','{{url('admin/user/'.$val->id.'/edit')}}',600,400)" href="javascript:;">
                                             <i class="layui-icon">&#xe642;</i>
                                         </a>
                                         <a title="删除" onclick="member_del(this,'{{$val->id}}')" href="javascript:;">
                                             <i class="layui-icon">&#xe640;</i>
                                         </a>
                                     </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body ">
                    <div class="page">
                        {!! $log->appends($request ->all())->render() !!}
                        {{--                        让数据自己按照自己设置每页条数分页--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>

    layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var  form = layui.form;

        // 监听全选
        form.on('checkbox(checkall)', function(data){

            if(data.elem.checked){
                $('tbody input').prop('checked',true);
            }else{
                $('tbody input').prop('checked',false);
            }
            form.render('checkbox');
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });


    });



    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.post('/admin/user/'+id,{"_method":"delete","_token":"{{csrf_token()}}"},function (data) {
                console.log(data);
                if(data.status==0){
                    $(obj).parent("tr").remove();
                    layer.msg(data.message,{icon:6,time:1000});
                    location.reload();
                }else {
                    layer.msg(data.message,{icon:5,time:1000});
                }
            })


        });
    }



    function delAll (argument) {
        let ids=new Array();  //定义一个数组来保存已选中的value值
        $('input[name="checkedId"]:checked').each(function(){
            if(!isNaN($(this).val())){
                ids.push($(this).val());
            }else{
                console.log("没拿到");
            }
        });
        if(ids.length == 0){
            layer.confirm('请选择删除的内容！');
            return false;
        }else {
            // console.log("拿到的数组为："+ids);
            layer.confirm('确认要删除吗？', function (index) {
                //捉到所有被选中的，发异步进行删除
                $.get("/admin/user/del", {'ids': ids}, function (data) {
                    if (data.status == 0) {
                        $(".layui-form-checked").not('.header').parent('tr').remove()
                        layer.msg(data.message, {icon: 6, time: 1000});
                        parent.location.reload(true);
                    } else {
                        layer.msg(data.message, {icon: 5, time: 1000});
                    }
                })
            });
        }
    }
</script>
</html>



