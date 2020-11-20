<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>药品查询</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @include('home.style.styles')
    @include('home.style.script')
</head>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="{{url('home/druglist')}}">
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
                <div class="layui-card-body layui-table-body layui-table-main">
                    <form class="layui-form"></form>
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>药名</th>
                            <th>药味</th>
                            <th>药性</th>
                            <th>归经</th>
                            <th>功效</th>
                            <th>单价</th>
                            <th>数量</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($drugst as $v)
                            <tr>
                                <td>{{$v->dsym}}</td>
                                <td>{{$v->dsyw}}</td>
                                <td>{{$v->dsyx}}</td>
                                <td>{{$v->dsgj}}</td>
                                <td>{{$v->dsgx}}</td>
                                <td>{{$v->jiage}}</td>
                                <td>{{$v->kucun}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="layui-card-body">
                    <div class="page">
                        <!--    下面的显示页数， 分页 -->
                        {!! $drugst->appends($request->all())->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>