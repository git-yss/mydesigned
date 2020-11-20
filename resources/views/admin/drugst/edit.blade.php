<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>编辑</title>
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
                    <span class="x-red">*</span>药名</label>
                <div class="layui-input-inline">
{{--                    隐藏id--}}
                    <input type="hidden" value="{{$drugst->id}}" name="uid"/>

                    <input type="text" id="L_tel"  value="{{$drugst->dsym}}" name="dsym" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
         </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>库存</label>
                <div class="layui-input-inline">
                    <input type="text"  id="L_username" value="{{$drugst->kucun}}" name="kucun" required="" lay-verify="feifushu" autocomplete="off" class="layui-input"></div>
            </div>
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>价格</label>
                <div class="layui-input-inline">
                    <input type="text" id="L_email" value="{{$drugst->jiage}}" name="jiage" required="" lay-verify="feifushu" autocomplete="off" class="layui-input"></div>
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
            //自定义验证规则
            form.verify({
                feifushu: [/^\d+(\.{0,1}\d+){0,1}$/,"只能输入非负的数"]
            });

            //监听提交
            form.on('submit(edit)', function(data) {
                //发异步，把数据提交给php
                var uid=$("input[name='uid']").val();
                $.ajax({
                    type:'PUT',
                    url:'/admin/drugst/'+uid,
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
