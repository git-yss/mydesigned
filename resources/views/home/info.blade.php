<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>个人信息</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @include('home.style.styles')
    @include('home.style.script')
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row" style="margin-right: 20px">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    头像
                </label>
                <div class="layui-input-inline">
                    <img src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=1663531614,707542069&fm=11&gp=0.jpg"
                         alt="你的头离家出走了" style="width:60px;height:60px">
                </div>
                <label class="layui-form-label">
                    用户名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" required="" lay-verify="required"
                           autocomplete="off" class="layui-input" value="{{session('User.username')}}">
                </div>
                <label  class="layui-form-label">
                    手机号
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="phone" name="phone" required="" lay-verify="required"
                           autocomplete="off" class="layui-input" value="{{session('User.tel')}}">
                </div>
                <label class="layui-form-label">
                    邮箱
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="email" name="email" required="" lay-verify="required"
                           autocomplete="off" class="layui-input" value="{{session('User.email')}}">
                </div>
            </div>
        </form>
    </div>
</div>

</body>
<script>
    layui.use(['form', 'layer','jquery'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

//自定义验证规则
            form.verify({
                nikename: function(value) {
                    if (value.length < 5) {
                        return '昵称至少得5个字符啊';
                    }
                },
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
                repass: function(value) {
                    if ($('#L_password').val() != $('#L_repass').val()) {
                        return '两次密码不一致';
                    }
                }
            });

//监听提交
            form.on('submit(edit)', function(data) {
//发异步，把数据提交给php
                var uid=$("input[name='uid']").val();
                $.ajax({
                    type:'PUT',
                    url:'/admin/user/'+uid,
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
