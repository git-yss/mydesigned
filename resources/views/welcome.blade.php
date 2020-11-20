 <!DOCTYPE html>
        <html class="x-admin-sm">
        <head>
            <meta charset="UTF-8">
            <title>TCM后台首页</title>
            <meta name="renderer" content="webkit">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
{{--
            <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
--}}
            <link rel="stylesheet" href="{{asset('X-Admin/css/font.css')}}">
            <link rel="stylesheet" href="{{asset('X-Admin/css/xadmin.css')}}">
            <script src="{{asset('X-Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
            <script type="text/javascript" src="{{asset('X-Admin/js/xadmin.js')}}"></script>
            <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
            <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
            <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
{{--            <script src="http://code.highcharts.com/highcharts.js"></script>--}}

            <script src="https://code.highcharts.com.cn/jquery/jquery-1.8.3.min.js"></script>
            <script src="https://code.highcharts.com.cn/highcharts/highcharts.js"></script>
            <script src="https://code.highcharts.com.cn/highcharts/modules/exporting.js"></script>
            <script src="https://code.highcharts.com.cn/highcharts/modules/data.js"></script>
            <script src="https://code.highcharts.com.cn/highcharts/modules/series-label.js"></script>
            <script src="https://code.highcharts.com.cn/highcharts/modules/oldie.js"></script>
            <script src="https://code.highcharts.com.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
        </head>
        <body>
<div style="background-color: white;font-size: 1.5em">
    医师人数：{{$usercount}}人<br>
    患者人数：{{$patientcount}}人<br>
    药材库存：{{$drugstcount}}种<br>
    访问量：{{$webcount}}次<br>
</div>
<div id="yuanbingtu" style="background-color: white;width: auto;height: 525px;">
</div>
<script language="JavaScript">
            Highcharts.chart('yuanbingtu', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: '资源份额'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: '资源',
                    colorByPoint: true,
                    data: [{
                        name: '中药数量',
                        y:{{$drugstcount}},
                        sliced: true,
                        selected: true
                    }, {
                        name: '患者数量',
                        y:{{$patientcount}}
                    }, {
                        name: '医生用户数量',
                        y:{{$usercount}}
                    }]
                }]
            });

        </script>
        </body>
</html>
