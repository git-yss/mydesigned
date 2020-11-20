<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>授权页面</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="{{asset('X-Admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('X-Admin/css/xadmin.css')}}">
    <script type="text/javascript" src="{{asset('X-Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('X-Admin/js/xadmin.js')}}"></script>

    <script type="text/javascript" src="{{asset('X-Admin/js/html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('X-Admin/js/respond.min.js')}}"></script>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form" action="{{url('admin/user/doAuth')}}" method="post">
            {{csrf_field()}}
            <div class="layui-form-item">
                <label for="L_tel" class="layui-form-label">
                    <span class="x-red">*</span>用户名称</label>
                <div class="layui-input-inline">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <input type="text" id="L_tel" name="user_name" value="{{$user->username}}" required="" lay-verify="" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_tel" class="layui-form-label">
                    <span class="x-red">*</span>授权角色列表</label>
                <div class="layui-input-inline" style="width: 600px;">
                    @foreach($role as $v)
                       @if(in_array($v->id,$own_role1))
                            <input type="checkbox" checked="checked" title="{{$v->rolename}}" name="role_id[]" value="{{$v->id}}" lay-skin="primary">
                        @else
                            <input type="checkbox" title="{{$v->rolename}}" name="role_id[]" value="{{$v->id}}" lay-skin="primary">
                        @endif
                   @endforeach
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                {{csrf_field()}}
                <button type="button" class="layui-btn" lay-filter="add" lay-submit="">授权</button>
            </div>
        </form>
    </div>
</div>
<script>
    layui.use(['form', 'layer','jquery'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //监听提交
            form.on('submit(add)', function(data) {
                //发异步，把数据提交给php

                $.ajax({
                    type: 'post',
                    url: '/admin/user/doAuth',
                    dateType: 'json',
                    //     // header:{
                    //     //     'X-CSRF-TOKEN':$('meta[name="csrf-token]').attr('content')
                    //     // },
                    data:data.field,

                });
            });

        });
</script>

</body>

</html>