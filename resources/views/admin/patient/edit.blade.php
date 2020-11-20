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
               <div>
{{--                    隐藏id--}}
                    <input type="hidden" value="{{$patient->id}}" name="uid"/>

                  </div>
             </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>姓名</label>
                <div class="layui-input-inline">
                    <input type="text" value="{{$patient->pname}}" id="L_username" name="pname" required="" lay-verify="nikename" autocomplete="off" class="layui-input"></div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>性别</label>
                <div class="layui-input-inline">
                    <input type="text" id="L_password" value="{{$patient->psex}}" name="psex" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
                </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                    <span class="x-red">*</span>身份证</label>
                <div class="layui-input-inline">
                    <input type="text" id="L_repass" value="{{$patient->pid}}" name="pid" required="identity" lay-verify="" autocomplete="off" class="layui-input"></div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                    <span class="x-red">*</span>出生日期</label>
                <div class="layui-input-inline">
                    <input type="date" id="L_repass" value="{{$patient->pdate}}" name="pdate" required="日期" lay-verify="auto" autocomplete="off" class="layui-input"></div>
            </div>
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>年龄</label>
                <div class="layui-input-inline">
                    <input type="text" disabled =“disabled” id="page" value="" placeholder="{{$patient->page}}" name="page" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                    <span class="x-red">*</span>手机号</label>
                <div class="layui-input-inline">
                    <input type="text" id="L_repass" value="{{$patient->ptel}}" name="ptel" required="phone" lay-verify="" autocomplete="off" class="layui-input"></div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                    <span class="x-red">*</span>家庭住址</label>
                <div class="layui-input-inline">
                    <input type="text" id="L_repass" value="{{$patient->padress}}" name="padress" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                {{csrf_field()}}
                <button type="button" class="layui-btn" lay-filter="edit" lay-submit="">修改</button></div>
        </form>
    </div>
</div>
<script>

    layui.use(['form', 'layer','jquery'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            form.verify({
                nikename: function(value) {
                    if (value.length < 2) {
                        return '昵称至少得2个字符啊';
                    }
                },

            });
            form.verify({
                auto: function(value) {
                    //计算出生日期对应的年龄
                    var addDate = $("input[name='pdate']").val();//注意时间格式是：2012-03-05 11:41:30.910//
                    addDate = new Date(Date.parse(addDate.replace(/\-/g, "/")));
                    var now = new Date();
                    var diff = now.getTime() - addDate.getTime(); //判断大于七天
                    page = Math.floor(diff / (365.25 * 24 * 60 * 60 * 1000))
                    document.getElementById("page").value = page;
                },

            });



            //监听提交
            form.on('submit(edit)', function(data) {
                //发异步，把数据提交给php
                var uid=$("input[name='uid']").val();
                layer.confirm('确认要修改吗？', function (index) {
                $.ajax({
                    type:'PUT',
                    url:'/admin/patient/'+uid,
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
                })

            });

        });
</script>

</body>

</html>
