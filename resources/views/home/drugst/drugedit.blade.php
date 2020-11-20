<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>修改药物信息</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    {{--csrf_token保护--}}
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8" />
    @include('home.style.styles')
    @include('home.style.script')
</head>
<style>
    .layui-form-item .layui-form-label
    {
        margin: 0;
    }
    .layui-input-inline
    {
        padding-left: 20px;
        margin: 10px;
    }
</style>
<body>
<div class="layui-fluid">
    <div class="layui-card-body">
        <form class="layui-form">
            <div>
                <div class="layui-input-inline">
                    药物
                </div>
                <div class="layui-input-inline">
                    <input type="hidden" value="{{$drugst->id}}" name="uid"/>
                    <input type="text" id="dsym" name="dsym" value="{{$drugst->dsym}}" required=""
                           autocomplete="off" class="layui-input">
                </div>
                <div  class="layui-input-inline">
                    功效
                </div>
                <div class="layui-input-inline">
                    <input type="text" id="dsgx" name="dsgx" value="{{$drugst->dsgx}}" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div>
                <div  class="layui-input-inline">
                    药味
                </div>
                <div class="layui-input-inline">
                    <input type="text" id="dsyw" name="dsyw" value="{{$drugst->dsyw}}" required=""
                           autocomplete="off" class="layui-input">
                </div>


                <div  class="layui-input-inline">
                    药性
                </div>
                <div class="layui-input-inline">
                    <input type="text" id="dsyx" name="dsyx" value="{{$drugst->dsyx}}"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div>
                <div  class="layui-input-inline">
                    归经
                </div>
                <div class="layui-input-inline">
                    <input type="text" id="dsgj" name="dsgj" value="{{$drugst->dsgj}}"
                           autocomplete="off" class="layui-input">
                </div>
                <div  class="layui-input-inline">
                    库存
                </div>
                <div class="layui-input-inline">
                    <input type="text" id="kucun" name="kucun" value="{{$drugst->kucun}}" lay-verify="feifushu"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div>
                <div  class="layui-input-inline">
                    价格
                </div>
                <div class="layui-input-inline">
                    <input type="text" id="dsjg" name="jiage" value="{{$drugst->jiage}}" lay-verify="feifushu"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <input type="button" class="layui-btn layui-btn-lg" lay-filter="edit" lay-submit="" value="修改">
                </div>

            </div>
        </form>
    </div>
</div>
<script>layui.use(['form', 'layer'],
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
                    url:'/home/drugstku/'+uid,
                    dateType:'json',
                    header:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token]').attr('content')
                    },
                        data: data.field,
                        success: function (data) {
                            //弹层提示添加成功，并刷新父页面（表单）
                            //console.log(data);
                            if (data.status == 0) {
                                layer.alert(data.message, {icon: 6}, function () {
                                    //刷新父页面
                                    window.parent.location.reload();
                                });
                            } else {
                                layer.alert(data.message, {icon: 5});
                            }
                        },
                        error: function () {
                            //错误信息
                        }
                    })
                });

        });
</script>
</body>

</html>

