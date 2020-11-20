<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>诊疗记录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @include('home.style.styles')
    @include('home.style.script')
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="{{url('home/patient')}}">
                        <div class="layui-inline layui-show-xs-block">

                            <input type="text" name="pname"  placeholder="请输入病人姓名" autocomplete="off" class="layui-input" value="{{$request->input('pname')}}">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input type="text" name="pid" placeholder="请输入病人身份证号" autocomplete="off" class="layui-input" value="{{$request->input('pid')}}">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input class="layui-input" autocomplete="off" placeholder="开始日期" name="startdate" id="start" value="{{$request->input('startdate')}}">
                        </div>
                        <label>=></label>
                        <div class="layui-inline layui-show-xs-block">
                            <input class="layui-input" autocomplete="off" placeholder="截止日期" name="enddate" id="end" value="{{$request->input('enddate')}}">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-body layui-table-body layui-table-main">
                    <form class="layui-form"></form>
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>年龄</th>
                            <th>身份证号</th>
                            <th>中医诊断</th>
                            <th>诊断时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($medicalr as $key)
                            <tr>
                                <td>{{$key->pname}}</td>
                                <td>{{$key->psex}}</td>
                                <td>{{$key->page}}</td>
                                <td>{{$key->pid}}</td>
                                <td>{{$key->zyzd}}</td>
                                <td>{{$key->pdate}}</td>

                                <td>
                                    <a href="javascript:" lay-event="edit" onclick="xadmin.open('查看记录',
                                            '{{url('home/patient/'.$key->id.'/edit')}}',900,550)" ><i class="layui-icon layui-icon-search"></i></a>
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
        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });
</script>
</html>
