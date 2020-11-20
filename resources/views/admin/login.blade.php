<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>中医门诊诊疗系统</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{asset('X-Admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('X-Admin/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('X-Admin/css/xadmin.css')}}">
    <script type="text/javascript" src="{{asset('X-Admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('X-Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('X-Admin/js/html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('X-Admin/js/respond.min.js')}}"></script>
</head>
<body class="login-bg">
<div class="login layui-anim layui-anim-up">
    <div class="message">中医诊疗系统登录</div>
    {{--错误提示--}}
    @if(is_object($errors))
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @else
        <li>{{$errors}}</li>
    @endif
    <div id="darkbannerwrap"></div>
    <form method="post" class="layui-form" action="{{route('captcha')}}">
        <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr15">

        {{csrf_field()}}
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20" >
        <a href="{{asset('/')}}">返回前台台登录</a>
    </form>
</div>


</body>
<script>
    window.onload = function () {
        localStorage.clear();
    }
</script>>
</html>
