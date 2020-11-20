<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav" >

            <li>
                <a onclick="xadmin.add_tab('病人诊疗','{{url('home/tcmform')}}')">
                    <i class="layui-icon layui-icon-username" lay-tips="病人诊疗"></i>
                    <cite>病人诊疗</cite>
                            {{-- 侧边导航栏的箭头符号  <i class="iconfont nav_right">&#xe697;</i>--}}
                </a>
                    </li>
                    <li>
                        <a  onclick="xadmin.add_tab('诊疗记录','{{url('home/patient')}}')">
                            <i class="layui-icon layui-icon-list" lay-tips="诊疗记录" style="font-size: large"></i>
                            <cite>诊疗记录</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('医案库','{{url('home/record')}}')">
                            <i class="layui-icon layui-icon-file" lay-tips="医案库"></i>
                            <cite>医案库</cite>
                        </a>
                    </li>
            <li>
                <a  onclick="xadmin.add_tab('中药库','{{url('home/drugstku')}}')">
                    <i class="layui-icon layui-icon-home" lay-tips="中药库"></i>
                    <cite>中药库</cite>
                </a>
            </li>

        </ul>
    </div>
</div>
