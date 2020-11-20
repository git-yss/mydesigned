<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>编辑页面</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="{{asset('X-Admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('X-Admin/css/xadmin.css')}}">
    <script type="text/javascript" src="{{asset('X-Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('X-Admin/js/xadmin.js')}}"></script>

    <script type="text/javascript" src="{{asset('X-Admin/js/html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('X-Admin/js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="L_tel" class="layui-form-label">
                    <span class="x-red">*</span>权限名称</label>
                <div class="layui-input-inline">
{{--                    隐藏id--}}
                    <input type="hidden" value="{{$permission->id}}" name="uid"/>

                    <input type="text" id="L_tel"  value="{{$permission->pername}}" name="pername" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
             </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>路由</label>
                <div class="layui-input-inline">
                    <input type="text" value="{{$permission->perurl}}" id="L_username" name="perurl" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
            </div>

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                {{csrf_field()}}
                <button type="button" class="layui-btn" lay-filter="edit" lay-submit="">修改</button></div>
        </form>
    </div>
</div>
<script>layui.use(['form', 'layer','jquery'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;


            //监听提交
            form.on('submit(edit)', function(data) {
                //发异步，把数据提交给php
                var uid=$("input[name='uid']").val();
                $.ajax({
                    type:'PUT',
                    url:'/admin/permission/'+uid,
                    dateType:'json',
                    header:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token]').attr('content')
                    },
                    data:data.field,
                    success:function (data) {
                        if(data.status==0){
                            layer.alert(data.message,{icon:6},function () {
                                parent.location.reload(true);
                            });
                        }else{
                            layer.alert(data.message,{icon:5});

                        }
                    },
                    error:function (data) {
                        //错误信息

                    }
                })

            });

        });
</script>

</body>

</html>
