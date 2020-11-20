<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>名医医案列表</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @include('home.style.styles')
    @include('home.style.script')
</head>
<style>
    #table1{
        table-layout: fixed;
        width: 960px;
    }
    #input{
        width: 130px;
    }
</style>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="{{url('home/record')}}">
                        <div class="layui-inline layui-show-xs-block">
                            <input id="input" type="text" name="pname" value="{{$request->input('pname')}}" placeholder="请输入病人姓名" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input id="input" type="text" name="zhusu" value="{{$request->input('zhusu')}}" placeholder="请输入主诉" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input id="input" type="text" name="zyzd" value="{{$request->input('zyzd')}}"placeholder="请输入中医诊断" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input id="input" type="text" name="xyzd" value="{{$request->input('xyzd')}}" placeholder="请输入西医诊断" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input id="input" type="text" name="zzzf" value="{{$request->input('zzzf')}}" placeholder="请输入治则治法" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-header">
                    <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                </div>
                <div class="layui-card-body layui-table-body layui-table-main">
                    <form class="layui-form"></form>
                    <table class="layui-table layui-form" id="table1" width="900px">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" lay-filter="checkall" name=""  lay-skin="primary">
                            </th>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>年龄</th>
                            <th>主诉</th>
                            <th>中医诊断</th>
                            <th>西医诊断</th>
                            <th>辩证分型</th>
                            <th>治则治法</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($medicalr as $key)
                            <tr>
                                <td>
                                    <input type="checkbox" data-id="{{$key->id}}" class="layui-unselect layui-form-checkbox" name="id"  lay-skin="primary">
                                </td>
                                <td>{{$key->pname}}</td>
                                <td>{{$key->psex}}</td>
                                <td>{{$key->page}}</td>
                                <td>{{$key->zhusu}}</td>
                                <td>{{$key->zyzd}}</td>
                                <td>{{$key->xyzd}}</td>
                                <td>{{$key->bzfx}}</td>
                                <td>{{$key->zzzf}}</td>
                                <td>
                                    <a href="javascript:" lay-event="edit" onclick="xadmin.open('查看医案','{{url('home/record/'.$key->id.'/edit')}}',900,500)" ><i class="layui-icon layui-icon-search"></i></a>
                                   <a href="javascript:" onclick="member_del(this,'{{$key->id}}')" ><i class="layui-icon layui-icon-delete"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body">
                    <div class="page">
                        <!--    下面的显示页数， 分页 -->
                        {!! $medicalr->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    layui.use([ "table", "form","laydate"], function () {
        let form = layui.form;
        var laydate=layui.laydate;
        var table=layui.table;
        // 监听全选1
        form.on('checkbox(checkall)', function(data){

            if(data.elem.checked){
                $('tbody input').prop('checked',true);
            }else{
                $('tbody input').prop('checked',false);
            }
            form.render('checkbox');
        });
    });
    //每行末尾删除
    function member_del(obj,id){
        layer.confirm('确认要取消添加医嘱吗？',function(index){

                json={
                    'id':id,
                    'active':"已标记"
                }
                console.log(json);
                $.ajax({
                    type: 'post',
                    url: '/home/record/record',
                    dateType: 'json',
                    // async:false,
                    header: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
                    },
                    data: json,
                    success: function (data) {
                        if (data.status==0)
                        {
                            //发异步删除数据
                            //移除标签
                            $(obj).parents("tr").remove();
                            layer.msg('已取消!',{icon:6,time:1000});
                        }else{
                            layer.msg('取消失败!',{icon:5,time:1000});
                        }
                    },
                });


            });

    }
    //监听批量删除
    function delAll(obj) {
        //获取要批量删除的用户Id
        var id = [];
        $(".layui-form-checked").not('.header').each(function (i, v) {
            //用这种写法获取data-id的值
            //var u=$(v).attr('data-id')取不到值
            var u = $(this).parent().find('input').data('id');
            id.push(u);
        })
        if (id.length == 0) {
            layer.confirm('请选择删除的内容！');
            return false;
        } else {
            //console.log(id);
            layer.confirm('确认要全部取消收藏吗？', function (index) {
                //捉到所有被选中的，发异步进行删除
                    json = {
                        'id': id,
                        // 'active': "已标记"
                    }
                  //  console.log(json)
                    $.ajax({
                        type: 'post',
                        url: '/home/record/record',
                        dateType: 'json',
                        // async:false,
                        header: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
                        },
                        data: json,
                        success: function (data) {
                            if (data.status == 0) {
                                //发异步删除数据
                                //移除标签
                               // $(".layui-form-checked").not('.header').parent('tr').remove();
                                $(obj).parents("tr").remove();
                                layer.msg('已取消!', {icon: 6, time: 1000});
                            } else {
                                layer.msg('取消失败!', {icon: 5, time: 1000});
                            }
                        }
                    });

            });
        }
    }
</script>
</html>
