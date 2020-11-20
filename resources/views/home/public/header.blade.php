<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="{{asset('admin/index')}}"></a></div>
    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>

    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">{{session('User.username')}}</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('个人信息','{{url('home/info')}}')">个人信息</a></dd>
                <dd>
                    <a href="{{url('home/logout')}}">退出</a></dd>
            </dl>
        </li>
    </ul>
</div>
<!-- 顶部结束 -->