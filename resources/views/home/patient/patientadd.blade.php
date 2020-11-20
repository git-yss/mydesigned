<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加患者</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @include('home.style.styles')
    @include('home.style.script')
</head>
<body>
<div align="left" style="margin-top: 10px">
    <button class="layui-btn" id="killall">清空数据</button>
    <button class="layui-btn" id="saveinfo">保存</button>
    <button class="layui-btn" onclick="xadmin.open('药品查询','{{url('home/druglist')}}',900,550)">药品查询</button>
</div>
<fieldset class="layui-field-title">
    <legend style="text-align: center;font-size: xx-large">病历</legend>
</fieldset>

<table class="layui-table">
    <tbody>
    {{--第一行--}}
    <tr style="height: 60px">
        <td style="width: 12.5%;font-size: large">姓名</td>
        <td style="width: 12.5%">
            <input type="text" class="layui-input" id="name" value="" autocomplete="off">
        </td>
        <td style="width: 12.5%;font-size: large">性别</td>
        <td style="width: 12.5%">
            <div style="margin: 5px;zoom:115%;padding-right: 10px" class="layui-input-inline">
                <input type="radio" value="男" title="男" name="sex" checked>
                <label>男</label>
            </div>
            <div style="margin: 5px;zoom:115%;padding-left: 10px" class="layui-input-inline">
                <input type="radio" value="女" title="女" name="sex">
                <label>女</label>
            </div>
        </td>
        <td style="width: 12.5%;font-size: large">出生日期</td>
        <td style="width: 12.5%;font-size: large">
            <input type="text" class="layui-input" id="birthday1" value="" placeholder="20201015" style="font-size: xx-small" autocomplete="off">
            <input type="hidden" class="layui-input" name="id" id="id" value="" >
        </td>

        <td style="width: 12.5%;font-size: large">年龄</td>
        <td style="width: 12.5%">
            <input type="text" class="layui-input" id="age" value="" disabled>
        </td>
    </tr>
    <tr style="height: 60px">
        <td style="width: 12.5%;font-size: large">身份证号</td>
        <td style="width: 12.5%" contentEditable="true">
            <input type="text" class="layui-input" id="idnumber" value="" onkeydown="entersearch()" autocomplete="off">
        </td>
        <td style="width: 12.5%;font-size: large">联系电话</td>
        <td style="width: 12.5%" contentEditable="true" >
            <input type="text" class="layui-input" id="phone" value="" onblur="checkphone()" autocomplete="off">
        </td>

        <td style="width: 8%;font-size: large">家庭住址</td>
        <td style="width: 12.5%" colspan="3" >
            <input type="text" class="layui-input" id="address" value="" autocomplete="off">
        </td>
    </tr>
    {{--第二行--}}
    <tr style="height: 50px">
        <td rowspan="2" style="font-size: large">主诉</td>
        <td rowspan="2" colspan="1">
            <input type="text" class="layui-input" id="chcom" value="" autocomplete="off">
        </td>
        <td rowspan="2" style="font-size: large">现病史</td>
        <td rowspan="2" colspan="1" >
            <input type="text" class="layui-input" id="hpi" value="无" autocomplete="off">
        </td>
        <td rowspan="2" style="font-size: large">既往史</td>
        <td rowspan="2" colspan="1">
            <input type="text" class="layui-input" id="pmh" value="无" autocomplete="off">
        </td>
        <td rowspan="2" style="font-size: large">过敏史</td>
        <td rowspan="2" colspan="1">
            <input type="text" class="layui-input" id="allergy" value="无" autocomplete="off">
        </td>
    </tr>
    </tbody>
    {{--第三行--}}
    <tbody>
    <tr style="height:50px">
        <td style="width: 5%;font-size: large">舌苔</td>
        <td style="width: 20%">
            {{-- <div id="tonfur" class="xm-select-demo"></div>--}}
            <input type="text" class="layui-input" id="tonfur" value="" autocomplete="off">
        </td>
        <td style="width: 5%;font-size: large">脉象</td>
        <td style="width: 20%">
            {{-- <div id="pulse" class="xm-select-demo"></div>--}}
            <input type="text" class="layui-input" id="pulse" value="" autocomplete="off">
        </td>
        <td style="width: 12.5%;font-size: large">辨证分型</td>
        <td style="width: 12.5%" >
            <input type="text" class="layui-input" id="dialetype" value="" autocomplete="off">
        </td>
        <td style="width: 12.5%;font-size: large">证素</td>
        <td style="width: 12.5%" >
            <input type="text" class="layui-input" id="cercate" value="" autocomplete="off">
        </td>
    </tr>
    <tr>
        <td rowspan="2" style="font-size: large">中医诊断</td>
        <td rowspan="2" colspan="2">
            <input type="text" class="layui-input" id="zdiagnosis" value="" autocomplete="off">
        </td>
        <td rowspan="2" style="font-size: large">西医诊断</td>
        <td rowspan="2" colspan="2">
            <input type="text" class="layui-input" id="xdiagnosis" value="" autocomplete="off">
        </td>
        <td rowspan="2" style="font-size: large">治则治法</td>
        <td rowspan="2" colspan="2">
            <input type="text" class="layui-input" id="rule" value="" autocomplete="off">
        </td>
    </tr>
    </tbody>
    <tbody>
    <tr>
        <td rowspan="2" style="font-size: large">药物组成</td>
        <td rowspan="2" colspan="5" >
            <input type="text" class="layui-input" id="drugs" value="" placeholder="请在下方表格选中药品" disabled>
        </td>
        <td rowspan="2" style="font-size: large">药物数量</td>
        <td rowspan="2" colspan="1">
            <input type="text" class="layui-input" id="drugsnum" value="" disabled="">
        </td>
    </tr>
    </tbody>
    {{--第四行--}}

    {{--第八行--}}
    <tbody>
    <tr>
        <td style="font-size: large">签名</td>
        <td colspan="3">
            <div style="float: left;margin-right: 5px">
                <input type="text" class="layui-input" id="dockername" value="" autocomplete="off" disabled>
            </div>
            <div style="float: left">
                <button class="layui-btn layui-btn-primary" id="docker">点击签名</button>
            </div>
        </td>
        <td style="font-size: large">就诊时间</td>
        <td colspan="3">
            <input type="text" class="layui-input" id="ctime" value="{{date('Y-m-d H:i:s',time())}}" disabled="">
        </td>
        <!--<td>价格</td>
        <td colspan="1" contentEditable="true" id="price"></td>-->
    </tr>
    </tbody>
</table>

<fieldset class="layui-field-title">
    <legend style="text-align: center;font-size: xx-large">处方</legend>
</fieldset>
<div class="layui-card-body layui-text">
    <div id="toolbar">
        <div>
            <button type="button" class="layui-btn" data-type="addRow" title="添加药品">
                <i class="layui-icon layui-icon-add-1"></i> 添加药品
            </button>
            <button type="button" name="btnSave" class="layui-btn" data-type="save"><i class="layui-icon layui-icon-ok-circle"></i>保存</button>
        </div>
    </div>
    <div id="tableRes" class="table-overlay">
        <table id="dataTable" lay-filter="dataTable" class="layui-hide"></table>
    </div>
    <div id="action" class="text-center">

</div>

</div>
</body>
<script>
    //定义数据
    window.viewObj = {
        tbData: [{
            //以时间戳为id
            tempId: new Date().valueOf(),
            name: '',
            count:''
        }]
    };
//输入完enter触发事件
    function entersearch(){
        var event = window.event || arguments.callee.caller.arguments[0];
        if (event.keyCode == 13)
        {
            p_idnumber=document.getElementById("idnumber").value;
               // console.log(p_idnumber);
            var idrule=/^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/
            if (!(idrule.test(p_idnumber))) {
                layer.alert("请填写正确的身份证号");
                document.getElementById('idnumber').value="";
            }else{
                jsonid= {
                    "p_idnumber": p_idnumber,
                      }
               // console.log(json);
                $.ajax({
                    type:'post',
                    url:'/home/tcmform/chaxun',
                    dateType:'json',
                    // async:false,
                    header:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token]').attr('content')
                    },
                    data:jsonid,
                    success(res){
                        console.log(res)
                        document.getElementById("id").value = res.id;
                        document.getElementById("name").value= res.pname;
                        document.getElementById("address").value = res.padress;
                        document.getElementById("birthday1").value= res.pdate;
                        document.getElementById("age").value = res.page;
                        document.getElementById("phone").value = res.ptel;
                        var radiovar = document.getElementsByName("sex");
                        var sex= res.psex;
                        if (sex=="女")
                        {
                            //console.log(radiovar[1])
                            radiovar[1].checked = "checked";
                        }else {
                            // console.log(345)
                            radiovar[0].checked = "checked";
                        }
                    }

                })
            };

        }
    }
    //判断手机号
    function checkphone() {
        var phone = document.getElementById('phone').value;
        if (!(/^1[3-9]\d{9}$/.test(phone))) {
            layer.alert("请填写正确的手机号");
            document.getElementById('phone').value="";
        }
    }


    //layui 模块化引用
    layui.use(['jquery', 'table', 'layer'], function(){
        var $ = layui.$,
            table = layui.table,
            form = layui.form,
            layer = layui.layer;

        //数据表格实例化
        var tbWidth = $("#tableRes").width();
        var layTableId = "layTable";
        var tableIns = table.render({
            elem: '#dataTable',
            id: layTableId,
            //获取上面定义的数据
            data: viewObj.tbData,
            //width: tbWidth,
            cols: [[
                {title: '序号', type: 'numbers'},
                {field: 'name', title: '药名', edit: 'text'},
                {field: 'count', title: '数量(单位：g)', edit: 'text'},
                {field: 'tempId', title: '操作', templet: function(d){
                        return '<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del" lay-id="'+ d.tempId +'"><i class="layui-icon layui-icon-delete"></i>移除</a>';
                    }}
            ]],
            //res为表内data数据，done是数据渲染完的回调,具体见官方文档
            done: function(res, curr, count){
                viewObj.tbData = res.data;
                //console.log(res.count);
            }
        });

        //定义事件集合
        var active = {
            addRow: function(){	//添加一行
                //渲染完成后获得之前表里的数据
                var oldData = table.cache[layTableId];
                console.log(oldData);
                var newRow = {tempId: new Date().valueOf(), name: '',count:''};
                //向之前的数据添加新数据，并返回新长度
                oldData.push(newRow);
                //表格重载
                tableIns.reload({
                    data : oldData
                });
            },
            updateRow: function(obj){
                var oldData = table.cache[layTableId];
                //console.log(oldData);
                for(var i=0, row; i < oldData.length; i++){
                    row = oldData[i];
                    if(row.tempId == obj.tempId){
                        //把obj合并到olddata
                        $.extend(oldData[i], obj);
                        return;
                    }
                }
                tableIns.reload({
                    data : oldData
                });
            },
            removeEmptyTableCache: function(){
                var oldData = table.cache[layTableId];
                for(var i=0, row; i < oldData.length; i++){
                    row = oldData[i];
                    if(!row || !row.tempId){
                        oldData.splice(i, 1);    //删除一项
                    }
                    continue;
                }
                tableIns.reload({
                    data : oldData
                });
            },
            save: function(){
                var oldData = table.cache[layTableId];
               // console.log(oldData);
                for(var i=0, row; i < oldData.length; i++){
                    row = oldData[i];
                    if(!row.name){
                        layer.msg("检查每一行药名，不需要请删除该行", { icon: 5 }); //提示
                        return;
                    }
                    if(!row.count){
                        layer.msg("检查每一行数量，不需要请删除该行", { icon: 5 }); //提示
                        return;
                    }
                }
                data=JSON.stringify(table.cache[layTableId], null, 2);//使用JSON.stringify() 格式化输出JSON字符串
                data=JSON.parse(data);
               // console.log( typeof data)
               // var drugst="";
               //  for( var j=0;j<data.length;j++){
               //      drugst+=data[j]
               //      //console.log(drugst);
               //  }
                json={
                   "data":data,
                }
               //  console.log(json)

                $.ajax({
                    type:'post',
                    url:'/home/tcmform/drugstpd',
                    dateType:'json',
                    header:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token]').attr('content')
                    },
                    data:json,
                    success(data){
                        var err="";
                        var another="";
                        for(var i=0;i<data.length;i++){
                            if(data[i].status==1){
                                err+=data[i].message+"<br>";
                            }else{
                                another+=data[i].dsym+":"+data[i].number+"g/";
                            }
                        }
                        if (err!="")
                        {
                            layer.msg(err,{icon:5});
                        }
                        document.getElementById("drugs").value = another;
                        document.getElementById("drugsnum").value = data.length;
                    }
                })
            }
        }

        //激活事件
        var activeByType = function (type, arg) {
            if(arguments.length === 2){
                active[type] ? active[type].call(this, arg) : '';
            }else{
                active[type] ? active[type].call(this) : '';
            }
        }

        //注册按钮事件
        $('.layui-btn[data-type]').on('click', function () {
            var type = $(this).data('type');
            activeByType(type);
        });
        //监听工具条
        table.on('tool(dataTable)', function (obj) {
            var data = obj.data, event = obj.event, tr = obj.tr; //获得当前行 tr 的DOM对象;
           // console.log(data);
            switch(event){
                case "del":
                    layer.confirm('真的删除行么？', function(index){
                        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        activeByType('removeEmptyTableCache');
                    });
                    break;
            }
        });
    });
    layui.use(['form','table','jquery','laydate'], function () {
        var form = layui.form;
        var table = layui.table;
        var $=layui.$;
        var laydate=layui.laydate;
        //渲染舌苔选择框

        //渲染脉象选择框

        //清空信息
        $('#killall').click(function () {
            layer.confirm(
                '是否清空信息重新输入？',
                {
                    btn: ['是的', '取消'] //按钮
                },
                function () {
                    window.parent.location.reload();
                });

            //获取值tonfur1=tonfur.getValue('nameStr')
        });
        //保存信息
        $('#saveinfo').click(function () {
            arr=[
                p_name=$('#name').val(),
                p_sex=$('input[name="sex"]:checked').val(),
                p_birthday=$('#birthday1').val(),
                p_age=$('#age').val(),
                p_idnumber=$('#idnumber').val(),
                p_phone=$('#phone').val(),
                p_address=$('#address').val(),
                p_chcom=$('#chcom').val(),
                p_hpi=$('#hpi').val(),
                p_pmh=$('#pmh').val(),
                p_allergy=$('#allergy').val(),
                p_tonfur=$('#tonfur').val(),
                p_pulse=$('#pulse').val(),
                p_dialetype=$('#dialetype').val(),
                p_cercate=$('#cercate').val(),
                p_zdiagnosis=$('#zdiagnosis').val(),
                p_xdiagnosis=$('#xdiagnosis').val(),
                p_rule=$('#rule').val(),
                p_drugs=$('#drugs').val(),
                p_ctime=$('#ctime').val(),
                p_dockername=$('#dockername').val(),
            ];
            p_id=$('#id').val();
            console.log('p_id')
            var active="";
            for (i=0;i<arr.length;i++) {
                if (arr[i] == "") {
                    layer.alert("请将病历填写完整后提交");
                    active = false;
                    break;
                } else {
                    active = true;
                }
            };
            if (active==true)
            {
                json= {
                    'p_name': p_name,
                    'p_sex': p_sex,
                    'p_birthday': p_birthday,
                    'p_id':p_id,
                    "p_age": p_age,
                    "p_idnumber": p_idnumber,
                    "p_phone": p_phone,
                    "p_address": p_address,
                    "p_chcom": p_chcom,
                    "p_hpi": p_hpi,
                    "p_pmh": p_pmh,
                    "p_allergy": p_allergy,
                    "p_tonfur": p_tonfur,
                    "p_pulse": p_pulse,
                    "p_dialetype": p_dialetype,
                    "p_cercate": p_cercate,
                    "p_zdiagnosis": p_zdiagnosis,
                    "p_xdiagnosis": p_xdiagnosis,
                    "p_rule": p_rule,
                    "p_drugs": p_drugs,
                    "p_dockername": p_dockername,
                    "p_ctime": p_ctime,
                }
               // console.log(json)
                $.ajax({
                    type:'post',
                    url:'/home/tcmform',
                    dateType:'json',
                    // async:false,
                    header:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token]').attr('content')
                    },
                    data:json,
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
            };

        })
    });
    //监听出生日期和年龄
    document.getElementById('birthday1').onchange=function (event) {
        var str=document.getElementById('birthday1').value;
        year=str.substring(0,4);
        mouth=str.substring(4,6);
        day=str.substring(6,8);
        str=year+"-"+mouth+"-"+day;
        data=new Date(str);
        y=data.getFullYear();
        m=data.getMonth()+1;//实际月份
        d=data.getDate();
        str=y+"-"+m+"-"+d;
        //判断年龄
        var nowdate=new Date();//可把当前时间替换成自己想要的日期
        var nowyear=nowdate.getFullYear();
        var nl=parseInt(nowyear)-parseInt(y);
        if(nl<=0){//如果出生年龄大于当前时间的话
            nl=0;
        }
        //自动设置年龄
        document.getElementById('age').value=nl;
        document.getElementById('birthday1').value=str;
    }

    //签名
    $('#docker').click(function () {
        arr=[
            p_name=$('#name').val(),
            p_sex=$('input[name="sex"]:checked').val(),
            p_birthday=$('#birthday1').val(),
            p_age=$('#age').val(),
            p_idnumber=$('#idnumber').val(),
            p_phone=$('#phone').val(),
            p_address=$('#address').val(),
            p_chcom=$('#chcom').val(),
            p_hpi=$('#hpi').val(),
            p_pmh=$('#pmh').val(),
            p_allergy=$('#allergy').val(),
            p_tonfur=$('#tonfur').val(),
            p_pulse=$('#pulse').val(),
            p_dialetype=$('#dialetype').val(),
            p_cercate=$('#cercate').val(),
            p_zdiagnosis=$('#zdiagnosis').val(),
            p_xdiagnosis=$('#xdiagnosis').val(),
            p_rule=$('#rule').val(),
            p_drugs=$('#drugs').val(),
        ]
        var active=""
        for (i=0;i<arr.length;i++) {
            if (arr[i] == "") {
                layer.alert("病历中有未填项目，请填写完后签名"+i);
                active = false;
                break;
            } else {
                active = true;
            }
        }
        if (active==true)
        {
            $('#docker').toggle();
            document.getElementById('dockername').value="{{session('User.username')}}";
        }

    })
</script>