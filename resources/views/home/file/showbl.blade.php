<head>
    <meta charset="utf-8">
    <title>查看记录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @include('home.style.styles')
    @include('home.style.script')
    <script src="{{asset('X-Admin/js/jquery-jqprint.js')}}"></script>
    <script src="{{asset('X-Admin/js/jquery-migrate-1.4.1.js')}}"></script>
</head>
<style>
    .layui-table th,.layui-table td
    {
        min-width: 30px;
    }
</style>
<body>
<div align="left" style="margin-top: 10px;margin-left: 10px">
    <button class="layui-btn" id="add" ></button>
    <button class="layui-btn" id="print" onclick="printtab()">打印</button>
</div>
<div id="printarea">
    <fieldset class="layui-field-title">
        <legend style="text-align: center;font-size: x-large">病历</legend>
    </fieldset>
    <table class="layui-table">
        <tr >
            <td >姓名</td>
            <td>
                <input type="text" class="layui-input" id="name" value="{{$patient->pname}}" autocomplete="off" disabled>
            </td>
            <td>性别</td>
            <td >
                <input type="text" class="layui-input" id="sex" value="{{$patient->psex}}" autocomplete="off" disabled>
            </td>
            <td >出生日期</td>
            <td>
                <input type="text" class="layui-input" id="birthday1" style="font-size: 10px" value="{{$patient->pdate}}" autocomplete="off" disabled>
            </td>
            <td>年龄</td>
            <td>
                <input type="text" class="layui-input" id="age" value="{{$patient->page}}" disabled>
            </td>
        </tr>
        <tr>
            <td >身份证号</td>
            <td colspan="3">
                <input type="text" class="layui-input" id="idnumber" value="{{$patient->pid}}"autocomplete="off" disabled>
            </td>
            <td>联系电话</td>
            <td colspan="3">
                <input type="text" class="layui-input" id="phone" value="{{$patient->ptel}}"  autocomplete="off" disabled>
            </td>
        </tr>
        <tr>
            <td>家庭住址</td>
            <td colspan="7">
                <input type="text" class="layui-input" id="address" value="{{$patient->padress}}" autocomplete="off" disabled>
            </td>
        </tr>
        <tr>
            <td>主诉</td>
            <td colspan="7">
                <input type="text" class="layui-input" id="chcom" value="{{$medicalr->zhusu}}" autocomplete="off" disabled>
            </td>
        </tr>
        <tr>
            <td>现病史</td>
            <td colspan="3">
                <input type="text" class="layui-input" id="hpi" value="{{$medicalr->xbs}}" autocomplete="off" disabled>
            </td>
            <td>既往史</td>
            <td  colspan="3">
                <input type="text" class="layui-input" id="pmh" value="{{$medicalr->jws}}" autocomplete="off" disabled>
            </td>
        </tr>
        <tr>
            <td>过敏史</td>
            <td  colspan="3">
                <input type="text" class="layui-input" id="allergy" value="{{$medicalr->gms}}" autocomplete="off" disabled>
            </td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <td>舌苔</td>
            <td colspan="3">
                <input type="text" class="layui-input" id="tonfur" value="{{$medicalr->st}}" autocomplete="off" disabled>
            </td>
            <td>脉象</td>
            <td colspan="3">
                <input type="text" class="layui-input" id="pulse" value="{{$medicalr->mx}}" autocomplete="off" disabled>
            </td>
        <tr>
        </tr>
        <td>辨证分型</td>
        <td >
            <input type="text" class="layui-input" id="dialetype" value="{{$medicalr->bzfx}}" autocomplete="off" disabled>
        </td>
        <td >证素</td>
        <td  >
            <input type="text" class="layui-input" id="cercate" value="{{$medicalr->zs}}" autocomplete="off" disabled>
        </td>
        <td  >治则治法</td>
        <td colspan="3">
            <input type="text" class="layui-input" id="rule" value="{{$medicalr->zzzf}}" autocomplete="off" disabled>
        </td>
        </tr>
        <tr>
            <td >中医诊断</td>
            <td colspan="3">
                <input type="text" class="layui-input" id="zdiagnosis" value="{{$medicalr->zyzd}}" autocomplete="off" disabled>
            </td>
            <td>西医诊断</td>
            <td colspan="3">
                <input type="text" class="layui-input" id="xdiagnosis" value="{{$medicalr->xyzd}}" autocomplete="off" disabled>
            </td>

        </tr>
        </tbody>
        <tbody>
        <tr>
            <td>药物组成</td>
            <td colspan="5">
                <input type="text" class="layui-input" id="drugs" value="{{$medicalr->ywzc}}" disabled>
            </td>

        </tr>
        </tbody>
        <tbody>
        <tr>
            <td >就诊时间</td>
            <td >
                <input type="text" class="layui-input" id="ctime" value="{{$medicalr->pdate}}" disabled="">
            </td>
            <td >医师签名</td>
            <td >
                <input type="text" class="layui-input" id="nikename" value="{{$medicalr->qm}}" disabled="">
                {{--            <input type="hidden" class="layui-input" id="active" value="{{$medicalr->active}}" disabled="">--}}
            </td>
        </tr>
        </tbody>
    </table>
</div>

</body>
<script>
    function printtab() {
        $("#printarea").jqprint();
    }
    //测试使用的active
    var active="{{$medicalr->active}}";
    window.onload=function(){
                if (active=='已标记')
                {
                    document.getElementById('add').innerText='已标记';
                }else {
                    document.getElementById('add').innerText='添加医案';
                }
    }
    if(active=='未标记'){
        $('#add').click(function () {
           var a= "{{$medicalr->id}}";
           json={
               'id':a,
               'active':"未标记"
           }
           //console.log(json);
            $.ajax({
                type: 'post',
                url: '/home/patient/record',
                dateType: 'json',
                // async:false,
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
                },
                data: json,
                success: function (data) {
                    if (data.status == 0) {
                        layer.alert(data.message, {icon: 6},function () {
                            window.location.reload();
                        });
                        //document.getElementById('add').innerText="已标记";
                    } else {
                        layer.msg(data.message, {icon: 5});
                    }
                },
            });
        })
    }else{
        $('#add').click(function () {
            var a= "{{$medicalr->id}}";
            json={
                'id':a,
                'active':"已标记"
            }
            console.log(json);
            $.ajax({
                type: 'post',
                url: '/home/patient/record',
                dateType: 'json',
                // async:false,
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
                },
                data: json,
                success: function (data) {
                    if (data.status == 0) {
                        //document.getElementById('add').innerText='添加医案';
                        layer.alert(data.message, {icon: 6},function () {
                            window.location.reload();
                        });
                        //document.getElementById('add').innerText="添加医案";
                    } else {
                        layer.msg(data.message, {icon: 5});

                    }
                },
            });
        })
    }


</script>