<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>中药列表</title>
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
                    <form class="layui-form layui-col-space5" method="get" action="{{url('home/drugstku')}}">
                        <div class="layui-input-inline" style="">
                            <input class="layui-input" placeholder="请输入药名" autocomplete="off" name="dsym" id="drugname" value="{{$request->input('dsym')}}">
                        </div>
                        <div class="layui-input-inline">
                            <input class="layui-input" placeholder="请输入功效" autocomplete="off" name="dsgx" value="{{$request->input('dsgx')}}">
                        </div>
                        <div class="layui-input-inline">
                            <input class="layui-input" placeholder="请输入归经" autocomplete="off" name="dsgj" value="{{$request->input('dsgj')}}">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-header">
                    <button class="layui-btn layui-btn-danger" onclick="xadmin.open('添加药物','{{url('home/drugstku/create')}}',700,500)"  ><i class="layui-icon"></i>添加药物</button>
                </div>
                <div class="layui-card-body layui-table-body layui-table-main">
                    <form class="layui-form"></form>
                    <table class="layui-table layui-form" id="table1" width="900px">
                        <thead>
                        <tr>

                            <th>序号</th>
                            <th>药物</th>
                            <th>功效</th>
                            <th>药味</th>
                            <th>药性</th>
                            <th>归经</th>
                            <th>库存</th>
                            <th>价格</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($drugst as $k=>$v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->dsym}}</td>
                                <td>{{$v->dsgx}}</td>
                                <td>{{$v->dsyw}}</td>
                                <td>{{$v->dsyx}}</td>
                                <td>{{$v->dsgj}}</td>
                                <td>{{$v->kucun}}</td>
                                <td>{{$v->jiage}}</td>
                                <td>
                                    <a href="javascript:" lay-event="edit" onclick="xadmin.open('修改药物信息','{{url('home/drugstku/'.$v->id.'/edit')}}',650,350)" ><i class="layui-icon layui-icon-edit"></i></a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body">
                    <div class="page">
                        <!--    下面的显示页数， 分页 -->
                        {!! $drugst->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script>

</script>
</html>
